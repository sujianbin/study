                            {volist name="html_models" id="vo"}
                                {if $vo["type"] == "dantu"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <div class="y-onlinemanage">
                                                <div class="y-file-list">
                                                    <ul class="clearfix">
                                                        <ul class="s-file-list" id="{$vo["field"]}">
                                                            {$vo["field"]|pic_show_tpl}

                                                        </ul>
                                                        <li class="file y-addpho js-uploadBox" onclick='webuploader(1,"{$vo["field"]}","{$controller}","");'>
                                                            <div class="adp">
                                                                <h1>+</h1>
                                                                <p>上传图片</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {elseif $vo["type"] == "duotu"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <div class="y-onlinemanage">
                                                <label style="color: red;">*拖动图片可排序</label>
                                                <div class="y-file-list">
                                                    <ul class="clearfix">
                                                        <ul class="s-file-list" id="{$vo["field"]}">
                                                            {$vo["field"]|piclist_show_tpl}

                                                        </ul>
                                                        <script type="text/javascript">
                                                            layer.ready(function(){
                                                                layer.photos({
                                                                    photos: $("#{$vo["field"]}"),
                                                                    anim: 0 //0-6的选择，指定弹出图片动画类型，默认随机
                                                                });
                                                            });
                                                        </script>
                                                        <li class="file y-addpho js-uploadBox" onclick='webuploader(20,"{$vo["field"]}","{$controller}","");'>
                                                            <div class="adp">
                                                                <h1>+</h1>
                                                                <p>上传多图</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {elseif $vo["type"] == "biaoti"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <input type="text" style="width:300px" name="{$vo["field"]}" value="{$vo["field"]|field_show}"/>
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {elseif $vo["type"] == "bianjiqiBaidu"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <script id="{$vo["field"]}" name="{$vo["field"]}" type="text/plain" style="width:90%;height:300px;margin-left: 10px;">{$vo["field"]|field_show}</script>
                                            <script type="text/javascript">UE.getEditor("{$vo["field"]}");</script>
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {elseif $vo["type"] == "riqi"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <input class="input" style="width:140px" onclick="WdatePicker({dateFmt:'yyyy-MM-dd H:mm:ss'})" class="date" type="text" name="{$vo["field"]}" id="{$vo["field"]}" value="{$vo['field']|time_show_tpl}" />
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {elseif $vo["type"] == "wenben"}

                                    <tr>
                                        <th width="20%">{$vo["name"]}</th>
                                        <td width="80%">
                                            <textarea style="width:80%; height:100px;" name="{$vo["field"]}">{$vo["field"]|field_show_tpl}</textarea>
                                            <br />
                                            <span class="ps">{$vo["msg"]}</span>
                                        </td>
                                    </tr>
                                {else}
                                {/if}
                            {/volist}