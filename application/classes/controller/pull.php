<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Pull extends Controller {
  public function action_index() {
    if(!empty($_POST)) {
      $payload = Arr::get($_POST,'payload',false);
      if(!$payload) {
	Kohana_Log::instance()->add(Kohana::ERROR, 'payload free post');
	return;
      }
      $payload = json_decode($payload);

      // prepare the log

      $commits = $payload->commits;
      $commit = $commits[count($commits)-1];
      Kohana_Log::instance()->add(Kohana::ERROR, $commit->message.' -- '.$commit->url);
      Kohana_Log::instance()->add(Kohana::ERROR, getcwd());
      $out = `git pull`;
      Kohana_Log::instance()->add(Kohana::ERROR, $out);
    }
    
  }
}
