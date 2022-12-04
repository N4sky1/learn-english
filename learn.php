<?php require_once 'header.php'; ?>
<?php require_once './functions/no-user-go-main.php'; ?>
<?php require_once './functions/get-words-to-learn.php'; ?>

<section class="learn">
    <div class="learn__select-hard select-hard">
        <div class="select-hard__wrap-item">
            <button>
                Учить легкие  
            </button>
            <span><?php echo $_SESSION['light_words'];?> слов</span>
        </div>
        
        <div class="select-hard__wrap-item">
            <button>
                Учить сложные 
            </button>
            <span><?php echo $_SESSION['strong_words'];?> слов</span>
        </div>
        
        <div class="select-hard__wrap-item">
            <button>
                Учить все 
            </button>
            <span><?php echo $_SESSION['all_words'];?> слов</span>
        </div>
        
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
        <div class="learn__study-count"></div>
    </div>
</section>


<?php require_once 'footer.php'; ?>
