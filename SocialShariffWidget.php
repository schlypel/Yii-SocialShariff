<?php

/**
 * SocialShariffWidget class file.
 *
 * @author schlypel <github@it.dyndns.pro>
 * @link https://github.com/schlypel/Yii-SocialShariff
 * @license MIT
 */

/**
 * SocialShariffWidget is a wrapper for Shariff, the privacy aware social media button solution from heise.de.
 * see: https://github.com/heiseonline/shariff
 * 
 * The following example shows how to use SocialShariffWidget:
 * 
 *
	<pre>
	$this->widget('ext.socialShariff.CoinSliderWidget', array(
		'theme' 		=> 'white',
		'orientation' 	=> 'vertical'
	));
	</pre>
 *
 *
 */

class SocialShariffWidget extends CWidget {

    /**
     * @var string name of theme (white, gray, none)
     */
    public $theme = 'white';

    /**
     * @var string orientation of buttons
     */
    public $orientation = 'vertical';
    
    /**
     * @var bool fontawesome allready loaded
     */
    public $loadFA = false;

    /**
     * @var bool jQuery allready loaded
     */
    public $loadJQ = false;

    /**
     * @var string holds the path to wiget assets
     */
    private $_assets;

    public function init() {

        if ($this->_assets === null) {
            $assetsPath = Yii::getPathOfAlias('ext.socialShariff.assets');
            $this->_assets = Yii::app()->getAssetManager()->publish($assetsPath);
        }
        Yii::app()->clientScript->registerScriptFile($this->_assets . '/' . $this->getScriptName(), CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile($this->_assets . '/' .  $this->getStylesheetName());
    }

    public function run() {
        $this->render('socialShariff', array(
			'theme' 		=> $this->theme,
			'orientation'	=> $this->orientation
        ));
    }

    /**
     *
     * @return string
     */
    private function getStylesheetName() {
        return $this->loadFA ? 'shariff.complete.css' : 'shariff.min.css';
    }

    /**
     *
     * @return string
     */
    private function getScriptName() {
        return $this->loadJQ ? 'shariff.complete.js' : 'shariff.min.js';
    }

}

?>
