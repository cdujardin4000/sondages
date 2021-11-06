<?php 

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. Cette liste est stockée dans un modèle
	 * de type "SurveysModel". L'utilisateur est ensuite dirigé vers la vue "ServeysView"
	 * permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		if(isset($_POST['keyword'])){
			$keyword = strtolower($_POST['keyword']) ;
			$surveys = $this->database->loadSurveysByKeyword($keyword);
			if(is_array($surveys)){//Le champ est rempli
				$this->setModel(new SurveysModel());
				$this->getModel()->setSurveys($surveys);
				$this->setView(getViewByName('surveys'));
			} else {
				$this->setModel(new MessageModel());
				$this->getModel()->setMessage('Erreur dans la recherche');
				$this->setView(getViewByName('Message'));
			}
		} else {//Le champ est vide
			$this->setModel(new MessageModel());
			$this->getModel()->setMessage('Veuillez entrer un mot pour la recherche!!');
			$this->setView(getViewByName('Message'));
		}
	}
}
?>
