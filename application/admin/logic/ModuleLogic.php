<?php
/**
 * ============================================================================
 * 版权所有 2018-2027  sujianbin，并保留所有权利。
 * 网站地址: https://sujianbin.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必得到允许, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: sujianbin
 * Date: 2018-09-14
 */
namespace app\admin\logic;

class ModuleLogic
{
    private $controllerPath;
    private $validatePath;
    private $htmlPath;
    private $newControllerPath;
    private $newValidatePath;
    private $dirPath;
    public function __construct()
    {
        $this->controllerPath = env('APP_PATH') . 'admin/controller/';
        $this->validatePath   = env('APP_PATH') . 'admin/validate/';
        $this->htmlPath       = env('APP_PATH') . 'admin/view/';
    }
    /**
     * 创建文件
     * @param  [type] $type [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function create($type, $data)
    {
        $controller = $data['controller'];
        $result     = $this->createController($controller, $type, $data);
        if ($result['code'] == 0) {
            $result = $this->createValidate($type, $controller);
            if ($result['code'] == 0) {
                $result = $this->createDir($controller);
                if ($result['code'] == 0) {
                    $result = $this->createHtml($controller, $type, $data);
                }
            }
        }
        return $result;
    }
    /**
     * 创建控制器
     * @param  [type] $controller [description]
     * @param  [type] $type       [description]
     * @param  [type] $data       [description]
     * @return [type]             [description]
     */
    private function createController($controller, $type, $data)
    {
        $json['code'] = 101;
        if ($type == 1) {
            $controllerPath = env('APP_PATH') . 'admin/tpl/controller_simple.php';
        } else if ($type == 2) {
            $controllerPath = env('APP_PATH') . 'admin/tpl/controller_cat.php';
        } else if ($type == 3) {
            $controllerPath = env('APP_PATH') . 'admin/tpl/controller_content.php';
        }
        $newControllerPath       = $this->controllerPath . $controller . '.php';
        $this->newControllerPath = $newControllerPath;
        $newController           = @fopen($newControllerPath, 'x+');
        if (!$newController) {
            $json['desc'] = '当前验证器已存在，不可重复创建';
        } else {
            if (!copy($controllerPath, $newControllerPath)) {
                $json['desc'] = '文件写入失败';
                //删除控制器
                @unlink($newControllerPath);
            } else {
                $content = file_get_contents($newControllerPath, 0);
                $content = str_replace(['@sujianbin@', '@controller@', '@cid@'], ['?php', $controller, $data['cid']], $content);
                file_put_contents($newControllerPath, $content);
                fclose($newController);
                $json['code'] = 0;
                $json['desc'] = '控制器创建成功';
            }
        }
        return $json;
    }
    /**
     * 创建验证器
     * @param  [type] $type       [description]
     * @param  [type] $controller [description]
     * @return [type]             [description]
     */
    private function createValidate($type, $controller)
    {
        $json['code'] = 101;
        //验证器
        if ($type == 1) {
            $validatePath = env('APP_PATH') . 'admin/tpl/validate_simple.php';
        } else if ($type == 2) {
            $validatePath = env('APP_PATH') . 'admin/tpl/validate_cat.php';
        } else if ($type == 3) {
            $validatePath = env('APP_PATH') . 'admin/tpl/validate_content.php';
        }
        $newValidatePath       = $this->validatePath . $controller . '.php';
        $newValidate           = @fopen($newValidatePath, 'x+');
        $this->newValidatePath = $newValidatePath;
        if (!$newValidate) {
            $json['desc'] = '当前验证器已存在，不可重复创建';
            //删除控制器
            @unlink($this->newControllerPath);
        } else {
            if (!copy($validatePath, $newValidatePath)) {
                $json['desc'] = '文件写入失败';
                //删除控制器
                @unlink($this->newControllerPath);
                @unlink($this->newValidatePath);
            } else {
                $content = file_get_contents($newValidatePath, 0);
                $content = str_replace(['@sujianbin@', '@controller@'], ['?php', $controller], $content);
                file_put_contents($newValidatePath, $content);
                fclose($newValidate);
                $json['code'] = 0;
                $json['desc'] = '验证器创建成功';
            }
        }
        return $json;
    }
    /**
     * 创建文件夹
     * @param  [type] $controller [description]
     * @return [type]             [description]
     */
    private function createDir($controller)
    {
        $json['code']  = 101;
        $dir           = $this->htmlPath . strtolower($controller);
        $this->dirPath = $dir;
        if (file_exists($dir)) {
            $json['desc'] = '模板文件夹已存在，请重命名控制器';
            //删除控制器
            @unlink($this->newControllerPath);
            @unlink($this->newValidatePath);
            @rmdir($this->dirPath);
        } else {
            mkdir($dir, 0777, true);
            $json['code'] = 0;
            $json['desc'] = '文件夹创建成功';
        }
        return $json;
    }
    /**
     * 创建静态模板
     * @param  [type] $controller [description]
     * @param  [type] $type       [description]
     * @param  [type] $data       [description]
     * @return [type]             [description]
     */
    private function createHtml($controller, $type, $data)
    {
        include env('APP_PATH') . 'admin/tpl/tpl_function.php';
        $json['code'] = 101;
        if ($type == 1) {
            $listPath    = env('APP_PATH') . 'admin/tpl/controller_simple_index.tpl';
            $newListPath = $this->htmlPath . strtolower($controller) . '/index.html';
            $newList     = @fopen($newListPath, 'x+');
            if (!copy($listPath, $newListPath)) {
                $json['desc'] = '文件写入失败';
                //删除控制器
                @unlink($this->newControllerPath);
                @unlink($this->newValidatePath);
                //删除文件夹
                del_file($this->dirPath);
                @rmdir($this->dirPath);
            } else {
                $content         = file_get_contents($listPath, 0);
                $categoryLogic   = new \app\admin\logic\CategoryLogic;
                $tplCategoryData = $categoryLogic->tplData($data['category_model'], $controller);
                $content         = str_replace(['@controller@', '@name@', '@tplCategoryData@'], [$controller, $data['cat_name'], $tplCategoryData], $content);
                file_put_contents($newListPath, $content);
                fclose($newList);
                $json['code'] = 0;
                $json['desc'] = '模块全部创建成功';
            }
        } else if ($type == 2) {
            $listPath      = env('APP_PATH') . 'admin/tpl/controller_cat_list.tpl';
            $modifyPath    = env('APP_PATH') . 'admin/tpl/controller_cat_modify.tpl';
            $newListPath   = $this->htmlPath . strtolower($controller) . '/index.html';
            $newModifyPath = $this->htmlPath . strtolower($controller) . '/modify.html';
            $newList       = @fopen($newListPath, 'x+');
            $newModify     = @fopen($newModifyPath, 'x+');
            if (!copy($listPath, $newListPath) || !copy($modifyPath, $newModifyPath)) {
                $json['desc'] = '文件写入失败';
                //删除控制器
                @unlink($this->newControllerPath);
                @unlink($this->newValidatePath);
                //删除文件夹
                del_file($this->dirPath);
                @rmdir($this->dirPath);
            } else {
                $content = file_get_contents($newListPath, 0);
                $content = str_replace(['@controller@', '@name@'], [$controller, $data['cat_name']], $content);
                file_put_contents($newListPath, $content);
                fclose($newList);
                $content         = file_get_contents($newModifyPath, 0);
                $categoryLogic   = new \app\admin\logic\CategoryLogic;
                $tplCategoryData = $categoryLogic->tplData($data['category_model'], $controller);
                $content         = str_replace(['@controller@', '@name@', '@tplCategoryData@'], [$controller, $data['cat_name'], $tplCategoryData], $content);
                file_put_contents($newModifyPath, $content);
                fclose($newModify);
                $json['code'] = 0;
                $json['desc'] = '模块全部创建成功';
            }
        } else if ($type == 3) {
            $listPath              = env('APP_PATH') . 'admin/tpl/controller_content_list.tpl';
            $modifyPath            = env('APP_PATH') . 'admin/tpl/controller_content_modify.tpl';
            $listCategoryPath      = env('APP_PATH') . 'admin/tpl/controller_content_cat_list.tpl';
            $modifyCategoryPath    = env('APP_PATH') . 'admin/tpl/controller_content_cat_modify.tpl';
            $newListPath           = $this->htmlPath . strtolower($controller) . '/index.html';
            $newModifyPath         = $this->htmlPath . strtolower($controller) . '/modify.html';
            $newListCategoryPath   = $this->htmlPath . strtolower($controller) . '/category.html';
            $newModifyCategoryPath = $this->htmlPath . strtolower($controller) . '/category_modify.html';
            $newList               = @fopen($newListPath, 'x+');
            $newModify             = @fopen($newModifyPath, 'x+');
            $newListCategory       = @fopen($newListCategoryPath, 'x+');
            $newModifyCategory     = @fopen($newModifyCategoryPath, 'x+');
            if (!copy($listPath, $newListPath) || !copy($modifyPath, $newModifyPath) || !copy($listCategoryPath, $newListCategoryPath) || !copy($modifyCategoryPath, $newModifyCategoryPath)) {
                $json['desc'] = '文件写入失败';
                //删除控制器
                @unlink($this->newControllerPath);
                @unlink($this->newValidatePath);
                //删除文件夹
                del_file($this->dirPath);
                @rmdir($this->dirPath);
            } else {
                $content = file_get_contents($newListPath, 0);
                $content = str_replace(['@controller@', '@name@'], [$controller, $data['cat_name']], $content);
                file_put_contents($newListPath, $content);
                fclose($newList);
                $content        = file_get_contents($newModifyPath, 0);
                $categoryLogic  = new \app\admin\logic\CategoryLogic;
                $tplContentData = $categoryLogic->tplData($data['content_model'], $controller);
                $content        = str_replace(['@controller@', '@name@', '@tplContentData@'], [$controller, $data['cat_name'], $tplContentData], $content);
                file_put_contents($newModifyPath, $content);
                fclose($newModify);
                $content = file_get_contents($newListCategoryPath, 0);
                $content = str_replace(['@controller@', '@name@'], [$controller, $data['cat_name']], $content);
                file_put_contents($newListCategoryPath, $content);
                fclose($newListCategory);
                $content         = file_get_contents($newModifyCategoryPath, 0);
                $tplCategoryData = $categoryLogic->tplData($data['category_model'], $controller);
                $content         = str_replace(['@controller@', '@name@', '@tplCategoryData@'], [$controller, $data['cat_name'], $tplCategoryData], $content);
                file_put_contents($newModifyCategoryPath, $content);
                fclose($newModifyCategory);
                $json['code'] = 0;
                $json['desc'] = '模块全部创建成功';
            }
        }
        return $json;
    }
}
