var video_conditions = [];
var waiting_video_url = "";
var not_predicted_url = "";
var waiting_video_id = 0;

var screen_code = window.prompt("Enter screen code: ");

var api_url = 'https://caroildetection.azurewebsites.net/back/api/client/adv/' + screen_code + '/send-adv' 
function adv_data () {
    $.ajax({
    type:'GET',
    url: api_url,
    success:function(data){
       console.log(data);
        video_conditions =  data.videos_list 
        waiting_video_url = data.waiting_url
        not_predicted_url = data.not_predicted_url;
        
    }}); 

 }

 adv_data()
 window.setInterval(adv_data,100000);

  var wait_interval = window.setInterval(function() {
    i = document.getElementById("wait").innerHTML;
    if (i > 0) {
      document.getElementById("wait").innerHTML = i - 1;
    } else {
      document.getElementById("wait_header").innerHTML = "";
      clearInterval(wait_interval);
    }
    // console.log("counting");
  }, 1000);

// get input video from camera
const videoEl = document.getElementById("inputVideo");
// canvas for storing the cropping face of person from the whole image
const canvas = document.getElementById("overlay");

// view video of the advertisement
var video1 = document.getElementById("myVideo");

// loading the models of faceapi
const URL = "static/models";


/* loading the glasses model 
The glasses model is converted from python. 
Other future models will be loaded in the same way
*/

var model = 0;
var model_car = 0;
async function load_cars() {
  model = await cocoSsd.load();
  console.log("model ssd have been loaded");

  model_car = await tf.loadLayersModel("static/models/model93/model.json");
  console.log("model cars have been loaded");

  const stream = await navigator.mediaDevices
    .getUserMedia({ video: true })
    .catch();

  videoEl.srcObject = stream;
  window.setInterval(function() {
    onPlay(videoEl);
  }, 1000);
}

load_cars();


var ctx = canvas.getContext("2d");
var carsdict = {
  0: "Chevrolet_Malibo",
  1: "Chevrolet_Silverado LD",
  2: "Chevrolet_Tahoe",
  3: "Ford_Expdition",
  4: "GMC_Yukon",
  5: "Hyundai_Accent",
  6: "Hyundai_Azera",
  7: "Hyundai_Elantra",
  8: "Hyundai_Santafe",
  9: "Hyundai_Sonata",
  10: "Hyundai_Tucson",
  11: "Nessan_Maxima",
  12: "Nessan_Patrol",
  13: "Nessan_Pickup",
  14: "Nessan_Sunny",
  15: "Nessan__Altima",
  16: "Toyota_Avalon",
  17: "Toyota_Camry",
  18: "Toyota_Corolla",
  19: "Toyota_FJ",
  20: "Toyota_Fortunter",
  21: "Toyota_Hiace",
  22: "Toyota_Hilux",
  23: "Toyota_Landcruiser",
  24: "Toyota_Rava4",
  25: "Toyota_Yaris",
  26: "kia_Cerato",
  27: "kia_Sportage",
  28: "lexus_ES",
  29: "lexus_GS",
  30: "lexus_GX",
  31: "lexus_LS"
};


async function onPlay(videoEl) {
  model.detect(videoEl).then(predictions => {
    // console.log("Predictions: ", predictions);

    all_predictions = [];

    predictions.forEach(item => {
      // console.log(item["class"]);
      all_predictions.push(item["class"]);

      if (item["class"] === "car" ||  item["class"] === "truck") {
        bbox = item["bbox"];
        //scale_factor = (320* 240) / (Math.round(bbox['2']) *  Math.round(bbox['3']))
        scale_factor = 2;
        // console.log(scale_factor);
        crop_left = Math.round(bbox["0"]) * scale_factor;
        crop_top = Math.round(bbox["1"]) * scale_factor;
        crop_width = Math.round(bbox["2"]) * scale_factor;
        crop_height = Math.round(bbox["3"]) * scale_factor;

        // console.log(crop_top);

        ctx.drawImage(
          videoEl,
          crop_left,
          crop_top,
          crop_width,
          crop_height,
          0,
          0,
          320,
          240
        );
        //ctx.drawImage(videoEl, 200, 200, 300, 250,0, 0, 320, 240);
        cars_predictions_sum = {};

        cars_predictions = model_car
          .predict(preprocessImage(canvas))
          .dataSync();
          
        

        selectedMax =  Math.max(...cars_predictions);
        // console.log(selectedMax);
        
        if(selectedMax >= .7) {
            car_id = cars_predictions.indexOf(Math.max(...cars_predictions));
    
            average_cars.push(car_id);
    
            average_cars.shift();
            predictedcar = mode(average_cars);
           
           document.getElementById("car_is").innerHTML = carsdict[predictedcar];
        }
         video_conditions.forEach(function (video_condition){            
            Object.keys(video_condition).forEach(function(key) {
                var video1 = document.getElementById("myVideo");
                var display =  document.getElementById("car_is").innerHTML;
                // console.log(display);

                if (video_condition[key] == display){ 
                  if(video1.getAttribute("src") != video_condition.video_url )
                  {
                    video1.setAttribute("src", video_condition.video_url);
                  }
                } 
            });
        })
        // console.log(document.getElementById("car_is"));
      }
    });
    if (!all_predictions.includes("car") && !all_predictions.includes("truck")) {
      document.getElementById("car_is").innerHTML = "No cars";
      if (video1.getAttribute("src") != not_predicted_url){
          video1.setAttribute("src", not_predicted_url)
        }
    }
    document.getElementById("detections").innerHTML = all_predictions;
  });
}


var average_cars = [100, 100, 100];

// run the smart ads
function preprocessImage(image) {
  let tensor = tf.browser
    .fromPixels(image)
    .resizeNearestNeighbor([224, 224])
    .toFloat();
  let offset = tf.scalar(127.5);
  return tensor
    .sub(offset)
    .div(offset)
    .expandDims();
}

function mode(array) {
  if (array.length == 0) return null;
  var modeMap = {};
  var maxEl = array[0],
    maxCount = 1;
  for (var i = 0; i < array.length; i++) {
    var el = array[i];
    if (modeMap[el] == null) modeMap[el] = 1;
    else modeMap[el]++;
    if (modeMap[el] > maxCount) {
      maxEl = el;
      maxCount = modeMap[el];
    }
  }
  return maxEl;
}
