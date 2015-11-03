<?php /* Smarty version 2.6.25-dev, created on 2015-11-02 22:59:50
         compiled from lesson12.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'lesson12.tpl', 35, false),array('function', 'html_options', 'lesson12.tpl', 75, false),array('modifier', 'default', 'lesson12.tpl', 35, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lesson 16</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
    </head>
    <body style="padding: 5px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div id="container" class="alert alert-info alert-dismissible" style="display: none" role="alert">
                        <button type="button" style="float: right;" onclick="$('#container').hide();
                        return false;" class="btn btn-info btn-sm">
                            <span aria-hidden="true">&times;</span></button>
                        <div id="container_info"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-5">
                    <div id="panel1" class="panel panel-primary">
                        <div class="panel-heading pagination-centered">
                            <h4>
                                Подача объявлений
                            </h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="ads_form" method="POST" role="form">
                                <div class="form-group form-group-sm">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <?php echo smarty_function_html_radios(array('name' => 'organization_form_id','options' => $this->_tpl_vars['organization_form'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['organization_form_id'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)),'separator' => "&nbsp;"), $this);?>

                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="seller_name" class="col-sm-2 control-label"><?php echo $this->_tpl_vars['ad_person']; ?>
</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="seller_name" class="form-control" id="seller_name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['seller_name'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Ваше имя">
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="email" class="col-sm-2 control-label">Эл. почта</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="email" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['email'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Электронная почта">
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <div class="col-sm-12">
                                        <div class="checkbox">
                                            <label for="allow_mails" class="col-sm-12 control-label">
                                                <input type="checkbox" value ="1" name="allow_mails" id="allow_mails" <?php echo $this->_tpl_vars['is_allow_mail']; ?>
> Я не хочу получать вопросы по объявлению по e-mail
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="phone" class="col-sm-2 control-label">Телефон</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone" class="form-control" id="phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Номер телефона">
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <div> <label for="location_id" class="col-sm-2 control-label">Город</label></div> 
                                    <div class="col-sm-10">

                                        <select class="form-control" title="Выберите город" id="location_id" name="location_id" required  > 
                                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['location_id']), $this);?>
 
                                        </select>   
                                    </div>
                                </div>   


                                <div class="form-group form-group-sm">
                                    <div> <label for="category_id" class="col-sm-2 control-label">Категория</label> 
                                        <div class="col-sm-10">

                                            <select class="form-control" title="Выберите категорию" id="category_id" name="category_id"  required>

                                                <?php $_from = $this->_tpl_vars['labels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['label']):
?>
                                                    <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
">
                                                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['subcategories'][$this->_tpl_vars['key']],'selected' => ((is_array($_tmp=@$this->_tpl_vars['category_id'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, ''))), $this);?>

                                                    </optgroup>
                                                <?php endforeach; endif; unset($_from); ?> 
                                            </select> 
                                        </div>   
                                    </div>   
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="title" class="col-sm-2 control-label">Название</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Название" required>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="desc" class="col-sm-2 control-label">Описание</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control" rows="3" required><?php echo ((is_array($_tmp=@$this->_tpl_vars['description'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label for="price" class="col-sm-2 control-label">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" class="form-control" id="price" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['price'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
" placeholder="Цена" required>
                                    </div>
                                </div>

                                <div class="col-md-offset-2 col-md-12"> 
                                    <div class="btn-group btn-group-md">
                                        <button type="submit" name="submit" id="submit_button" value="Добавить" class="btn btn-default">Добавить</button>     
                                        <button type="button"  class="btn btn-default" name="cancel" id="cancel_button">Отмена</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'table.tpl.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-2.1.4.min.js"><\/script>');</script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="./js/functions.js"></script>             

    </body>
</html>