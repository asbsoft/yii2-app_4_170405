<?php

namespace project\modules\sys\models;

use asb\yii2\common_2_170212\controllers\BaseController;

use yii\base\Model;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use Yii;

class LayoutModel extends Model
{
    /** Directory for saving current layout info */
    public static $saveArea = '@data/layout';

    /** Frontend layouts place path */
    public static $layoutPath = '@project/views/layouts'; //!! Yii::$app->layoutPath another for backend

    /** Possible layout extensions */
    public static $layoutExtensions = ['php', 'twig', 'tpl'];

    /** Pattern for layout description file name */
    public static $patternLayoutDescriptionFilename = "%s/%s/info.json";

    /** Pattern of main template in layout */
    public static $patternTemplate = "%s/%s/index.%s";

    /** Pattern of filename for save current layout */
    public static $patternSaveFname = "%s/%s-layout.dat";

    public static $tcModule = 'app/sys/module';

    public $alias;
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * Saves current record.
     * @return bool whether the saving succeeded (i.e. no validation errors occurred).
     */
    public function save()
    {
        if (static::existsLayout($this->alias)) {
            $saveDir = Yii::getAlias(static::$saveArea);
            if (!is_dir($saveDir)) {
                $this->addError('alias', Yii::t($this->tcModule
                  , "Data directory '{saveDir}' not found", ['saveDir' => $saveDir]));
                return false;
            }
            $filename = sprintf(static::$patternSaveFname, $saveDir, Yii::$app->appTemplate);
            $data = serialize($this->alias);
            return file_put_contents($filename, $data);
        } else {
            $this->addError('alias', Yii::t($this->tcModule
              , "Layout '{layout}' not found", ['layout' => $this->alias]));
            return false;
        }
    }

    /** Get saved layout */
    public static function getSavedLayout($appTemplate, $defaultLayout = 'main')
    {
        $saveDir = Yii::getAlias(static::$saveArea);
        $filename = sprintf(static::$patternSaveFname, $saveDir, $appTemplate);
        if (!is_file($filename)) {
            return $defaultLayout;
        }
        $data = file_get_contents($filename);
        $layout = unserialize($data);
        if (static::existsLayout($layout)) {
            return $layout;
        } else {
            return $defaultLayout;
        }
    }

    protected static $_layoutsList = [];
    /** @return array layouts list */
    public static function layoutsList()
    {
        if (empty(static::$_layoutsList)) {
            $layoutPath = Yii::getAlias(static::$layoutPath);
            $handle = opendir($layoutPath);
            if ($handle === false) {
                throw new InvalidParamException("Unable to open directory '$layoutPath'");
            }
            while (($file = readdir($handle)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $path = $layoutPath . DIRECTORY_SEPARATOR . $file;
                if (is_file($path)) {
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $alias = basename(pathinfo($path, PATHINFO_BASENAME), ".{$ext}");
                    $mainTemplate = sprintf(static::$patternTemplate, $layoutPath, $alias, $ext);
                    if (in_array($ext, static::$layoutExtensions) && is_file($mainTemplate)) {
                        $name = static::getLayoutName($alias);
                        static::$_layoutsList[$alias] = $name;
                    }
                }
            }
            closedir($handle);
        }
        return static::$_layoutsList;
    }

    public static function existsLayout($alias)
    {
        $aliases = array_keys(static::layoutsList());
        return in_array($alias, $aliases);
    }
    
    /**
     * Find layout name from context/descriptions/etc
     * @return string|array name or names in format array('en' => '...', ...)
     */
    public static function getLayoutName($alias)
    {
        $name = "Layout '{$alias}'"; // default if not found

        $filename = sprintf(static::$patternLayoutDescriptionFilename, Yii::getAlias(static::$layoutPath), $alias);
        if (is_file($filename)) {
            $text = file_get_contents($filename);
            try {
                $info = Json::decode($text);
            } catch (InvalidParamException $ex) {
                $msg = "File '{$filename}' problems: {$ex->getMessage()}";
                Yii::error($msg);
            }
            if (!empty($info['name'])) {
                $name = $info['name'];
            }
        }
        return $name;
    }

}
