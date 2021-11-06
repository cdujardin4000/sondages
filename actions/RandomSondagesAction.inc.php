<?php 

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class RandomSondagesAction extends Action {

	/**
	 * Récupérer 3 sondages au hazard a l'aide de getRandomSurveys($nb)
	 * Donner ces sondages au modele SurveysModel
	 * Afficher la vue SurveysView
	 *
	 *
	 * @see Action::run()
	 */
	public function run() {
		$surveys = $this->database->getRandomSurveys(3);

		$this->setModel(new SurveysModel());
		$this->getModel()->setSurveys($surveys);

		$this->setView(getViewByName('Surveys'));
	}

}


