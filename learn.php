<?php require_once 'header.php'; ?>
<?php require_once './connect-for-users.php'; ?>
<?php require_once './functions/no-user-go-main.php'; ?>
<?php require_once './functions/get-words-to-learn.php'; ?>

<section class="learn">
    <div class="learn__select-hard">
        <button>
            Учить легкие
        </button>
        <button>
            Учить сложные
        </button>
        <button>
            Учить все
        </button>
    </div>
    <div class="learn__select-lang">
        <button>
            Англо-Русский
        </button>
        <button>
            Русско-Английский
        </button>
    </div>
    <div class="learn__study">
        <div class="learn__study-words">
            <div class="learn__study-first"></div>
            <div class="learn__study-second"></div>
        </div>
        <div class="learn__study-show-wrap">
            <button class="learn__study-show">Показать</button>
        </div>
        <div class="learn__study-buttons">
           <button class="learn__study-yes">Знаю</button>
            <button class="learn__study-no">Не знаю</button> 
        </div>    
    </div>
</section>


<?php require_once 'footer.php'; ?>
