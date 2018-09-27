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
                    <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/index')}">@name@列表</button>
                    <button type="button" class="btn btn-primary btn-redirect btn-current" name="{:url('@controller@/modify')}">添加@name@</button>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/category')}">@name@类别列表</button>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/categoryModify')}">添加@name@类别</button>
                </div>
                <div class="Manager_style">
                    <div class="title_name">{$model['id']|tag_show=['添加','编辑']}@name@类别</div>
                    <div class="Role_list">
                        <form name="myform" action="{:url('@controller@/update')}" method="post">
                            <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                                <tbody>

                                    <tr>
                                        <th width="20%">栏目名称</th>
                                        <td width="80%"><input type="text" style="width:300px" name="title" value="{$model['title']}"/>
                                            <br />
                                            <span class="ps"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="20%">所属栏目</th>
                                        <td width="80%">
                                            <select name="cat_id" style="margin-left: 10px;height:35px">
                                                {volist name="parent_list" id="vo"}
                                                    <option value="{$vo['cat_id']}">{$vo['cat_name']}</option>
                                                {/volist}
                                            </select>
                                        </td>
                                    </tr>
                                    @tplContentData@
                                    
                                    <tr>
                                        <th width="20%">排序</th>
                                        <td width="80%">
                                            <input type="text" name="order_id" value="{if empty($model['order_id'])}1000{else}{$model['order_id']}{/if}" style="width:56px;text-align: center;">
                                            <br />
                                            <span class="ps">排序字段为1-999999之间的数字</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="20%">是否显示</th>
                                        <td width="80%">
                                            <div class="radio-box">
                                                <label class="open {if !isset($model['is_show']) or $model['is_show'] eq 1}selected{/if}" data-value="是">
                                                    <input type="radio" name="is_show" value="1"/>
                                                </label>
                                                <label class="close {if isset($model['is_show']) and $model['is_show'] eq 0}selected{/if}" data-value="否">
                                                    <input type="radio" name="is_show" value="0" />
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

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
                                <input type="hidden" name="id" value="{$model['id']}"/>
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
            $("selecte[name=parent_id] option[value={$model['parent_id']}]").prop('selected','selected');
            $("input[type=radio][name=is_show][value={$model['is_show']}]").prop("checked","checked");
        });
    </script>
</html>