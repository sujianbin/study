<!DOCTYPE html>
<html>
    <head>
        {layout name="public/layout" /}
    </head>
    <body>
        <div class="page-content">
            <div class="Role_Manager_style">
                <div class="Manager_style">
                    <div class="title_name">菜单列表</div>
                    <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                    <button type="button" class="btn btn-primary btn-redirect btn-current" name="{:url('@controller@/index')}">@name@</button>
                </div>
                <div class="Manager_style">
                    <div class="title_name">{$model['cat_id']|tag_show=['添加','编辑']}@name@</div>
                    <div class="Role_list">
                        <form name="myform" action="{:url('@controller@/update')}" method="post">
                            <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                                <tbody>

                                    <tr>
                                        <th width="20%">栏目名称</th>
                                        <td width="80%"><input type="text" style="width:300px" name="cat_name" value="{$model['cat_name']}"/>
                                            <br />
                                            <span class="ps"></span>
                                        </td>
                                    </tr>
                                    
                                    @tplCategoryData@
                                    
                                    <tr>
                                        <th width="20%">页面标题</th>
                                        <td width="80%"><input type="text" style="width:40%;" name="seo_title" value="{$model['seo_meta']['seo_title']}"><br/><span class="ps">不填写默认为栏目名称</span></td>
                                    </tr>

                                    <tr>
                                        <th width="20%">页面关键字</th>
                                        <td width="80%"><input type="text" style="width:80%;" name="seo_keywords" value="{$model['seo_meta']['seo_keywords']}"></td>
                                    </tr>

                                    <tr>
                                        <th width="20%">页面描述</th>
                                        <td width="80%"><textarea style="width:80%; height:100px;" name="seo_description">{$model['seo_meta']['seo_description']}</textarea></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="btn_operating">
                                <input type="hidden" name="cat_id" value="{$model['cat_id']}"/>
                                <input  type="submit" class="btn btn-primary btn-submit"/>
                                <input  type="reset" class="btn btn-warning"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(function(){
            $("input[type=radio][name=is_show][value={$model['is_show']}]").prop("checked","checked");
        });
    </script>
</html>