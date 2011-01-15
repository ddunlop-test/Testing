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
      $out = `git pull`;
      Kohana_Log::instance()->add(Kohana::ERROR, $out);
    }
    
  }

  public function action_test() {
    echo 'tested';
  }
}


/*

Array
(
    [payload] => {
  "ref":"refs\/heads\/master",
  "after":"7f26f700647d3701a2435d60d3766f7a818452b2",
  "compare":"https:\/\/github.com\/ddunlop-test\/Testing\/compare\/cc6ff53...7f26f70",
  "repository":{"language":"PHP","pushed_at":"2010/07/31 09:48:21 -0700","has_wiki":true,"created_at":"2010/06/28 18:52:30 -0700","open_issues":0,"description":"Test GitHub","fork":false,"forks":2,"has_issues":true,"private":false,"size":180,"has_downloads":true,"owner":{"email":"github@ddunlop.otherinbox.com","name":"ddunlop-test"},"name":"Testing","url":"https:\/\/github.com\/ddunlop-test\/Testing","watchers":3,"homepage":""},

  "commits":[{"author":{"email":"github2@ddunlop.oterinbox.com","name":"ddunlop"},"timestamp":"2010-07-31T09:12:56-07:00","added":[],"message":"Testing hook","removed":[],"modified":["index.php"],"url":"https:\/\/github.com\/ddunlop-test\/Testing\/commit\/71b2eba13e6e3d0e688491767083f2f2e1dbd5d3","id":"71b2eba13e6e3d0e688491767083f2f2e1dbd5d3"},{"author":{"email":"github2@ddunlop.oterinbox.com","name":"ddunlop"},"timestamp":"2010-07-31T09:15:24-07:00","added":[],"message":"Testing hook","removed":[],"modified":["index.php"],"url":"https:\/\/github.com\/ddunlop-test\/Testing\/commit\/885d00bb47102a6fbf5c22b3f58f742964ee6e03","id":"885d00bb47102a6fbf5c22b3f58f742964ee6e03"},{"author":{"email":"github2@ddunlop.oterinbox.com","name":"ddunlop"},"timestamp":"2010-07-31T09:48:15-07:00","added":[],"message":"Testing hook","removed":[],"modified":["index.php"],"url":"https:\/\/github.com\/ddunlop-test\/Testing\/commit\/7f26f700647d3701a2435d60d3766f7a818452b2","id":"7f26f700647d3701a2435d60d3766f7a818452b2"}],

  "forced":false,

  "before":"cc6ff5384c914510d31babf79ff503cd10937a1d"}
)

*/
