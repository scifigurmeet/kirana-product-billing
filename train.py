from imageai.Prediction.Custom import ModelTraining

model_trainer = ModelTraining()
model_trainer.setModelTypeAsResNet()
model_trainer.setDataDirectory("rashan")
model_trainer.trainModel(num_objects=12, num_experiments=200, enhance_data=True, batch_size=16, show_network_summary=True)
