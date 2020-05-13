from bottle import route, run
from imageai.Prediction.Custom import CustomImagePrediction

def loadModel():
	prediction = CustomImagePrediction()
	prediction.setModelTypeAsResNet()
	prediction.setModelPath("model200.h5")
	prediction.setJsonPath("class1.json")
	prediction.loadModel(num_objects=12)
	return prediction
	
predictionX = loadModel()

@route('/')
def hello():
	predictions, probabilities = predictionX.predictImage("C:/xampp/htdocs/tcs/temp.jpg", result_count=1)
	for eachPrediction, eachProbability in zip(predictions, probabilities):
		item = eachPrediction
	return item

run(host='localhost', port=85, debug=True)
