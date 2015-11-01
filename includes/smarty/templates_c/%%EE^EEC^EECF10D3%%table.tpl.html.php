<?php /* Smarty version 2.6.25-dev, created on 2015-10-22 22:08:26
         compiled from table.tpl.html */ ?>
<div id="panel2" class="panel panel-primary">
    <div class="panel-heading pagination-centered">
        <h4>
            Список объявлений 
        </h4>
    </div>
    <!--<div class="panel-body">-->
        <div class="span3">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-xs-4">Название</th>
                        <th class="col-xs-1"></th>
                        <th class="col-xs-3">Имя</th>
                        <th class="col-xs-3">Цена</th>
                        <th class="col-xs-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $this->_tpl_vars['ads_rows']; ?>

                </tbody>
            </table>
        </div>
    <!--</div>-->
</div>