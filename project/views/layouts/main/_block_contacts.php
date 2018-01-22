
    <div class="text-center">
        <h1 class="text-center">
            <small><?= Yii::t($tc, 'Contacts') ?></small>
        </h1>

        <div class="col-md-4 col-md-offset-2 text-justify">
            <?php if ($mainLang == 'ru'): ?>
                <p>Статический текст можно ввести здесь, но нужно учесть язык.
                   Поэтому лучше использовать возможности мультиязычного виджета
                   '/sys/content/main/render' из контент менеджера.
                </p>
                <p>Лорем ипсум долор сит амет, цонсецтетуер адиписцинг елит, сед диам нонуммй нибх еуисмод тинцидунт ут лаореет долоре магна алиqуам ерат волутпат. Ут виси еним ад миним вениам, qуис ноструд ехерци татион улламцорпер сусципит лобортис нисл ут алиqуип ех еа цоммодо цонсеqуат. Дуис аутем вел еум ириуре долор ин хендрерит ин вулпутате велит ессе молестие цонсеqуат, вел иллум долоре еу феугиат нулла фацилисис ат веро ерос ет аццумсан ет иусто одио дигниссим qуи бландит праесент луптатум ззрил деленит аугуе дуис долоре те феугаит нулла фацилиси.
                </p>
            <?php else:  // default - 'en' ?>
                <p>Static text can be input here, but need to consider the language.
                   Therefore better use facilities of multilang widget
                   '/sys/content/main/render' from content-manager.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                </p>
            <?php endif; ?>

            <?= Yii::$app->runAction('/sys/content/main/render', [
                'id' => '/startpage-blocks/block-contacts',
            ]) ?>
        </div>

        <div class="col-md-5">
            <h3><?= Yii::t($tc, 'Send your message here') ?></h3>
        </div>
        <div id="<?= $contactFormTagId ?>" class="contact-from col-md-5">
            <?= Yii::$app->runAction("/{$contactsModuleUid}/main/form", [
                'ajaxReceiver' => $contactFormTagId,
            ]) ?>
        </div>
    
    </div>
