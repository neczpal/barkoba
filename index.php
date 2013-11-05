<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Guess what!</title>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <? 
               include 'inc/connection.php';
               $ids = array();
               $lefts = array();
               $rights = array();
               $parents = array();
               $datas = array();
               
               $result = mysqli_query($connection, "SELECT * FROM `barkoba`");
               
               $i = 0;
               while($row = mysqli_fetch_array($result)){
                   $ids[$i] = $row['id'];
                   $datas[$i] = $row['data'];
                   $lefts[$i] = $row['left'];
                   $rights[$i] = $row['right'];
                   $parents[$i] = $row['parent'];
                   $i++;
               }
               
        ?>
        <script src="js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript">
            var ids = [];
            <?
               for($j=0; $j < $i; $j++){
                   echo "ids[".$j."]=".$ids[$j].";\n";
               }
            ?>
            var datas = [];
            <?
               for($j=0; $j < $i; $j++){
                   echo "datas[".$j."]=\"".$datas[$j]."\";\n";
               }
            ?>
            var lefts = [];
            <?
               for($j=0; $j < $i; $j++){
                   echo "lefts[".$j."]=".$lefts[$j].";\n";
               }
            ?>
            var rights = [];
            <?
               for($j=0; $j < $i; $j++){
                   echo "rights[".$j."]=".$rights[$j].";\n";
               }
            ?>
            var parents = [];
            <?
               for($j=0; $j < $i; $j++){
                   echo "parents[".$j."]=".$parents[$j].";\n";
               }
            ?>
                
            var current = 0;
            
            function igen(){
                if(current === -1){
                    build(0);
                }else
                if(lefts[current] === -1){
                    build(-1);//Correct
                }else{
                    build(lefts[current]);
                }
            }
            function nem(){
                if(current === -1){
                    if (confirm("Of course you do! So another game??")) {
                        build(0);
                    }else{
                        build(0);
                    }
                }else
                if(rights[current] === -1){
                    build(-2);
                }else{
                    build(rights[current]);
                }
            }
            function ask(sz){
                $("#game").html("<h1 id='question'>"+sz+"</h1>"+
                "<div id='inline'>"+
                    "<div onclick='igen()'>Yes</div>"+
                    "<div onclick='nem()'>No</div>"+
                "</div>");
            }
            function initUpdate(){
                $("#game").html("<h1 id='question'>I don't know</h1>"+
                "<div id='content'>"+
                    "<span>What were you thinking?</span><br/>"+
                    "<input type='text' id='new_one' /><br/>"+
                    "<span>Give a question that is true for it but not for the "+datas[current]+"!<br/>"+
                    "<input type='text' id='new_question' /><br/>"+
                    "<input type='button' onclick='send()' value='Send' />"+
                "</div>");
            }
            function build(id){
                switch(id){
                    case -2:
                        initUpdate();
                    break;
                    
                    case -1:
                        ask("I guessed it. New game?");
                        current = -1;
                    break;
                    
                    case 0:
                        current = 0;
                        ask(datas[0]);
                        break;
                        
                    default:
                        ask(datas[id]);
                        current = id;
                }
            }
            
            function send(){
                var new_one = $("#new_one").val();
                var new_question = $("#new_question").val();
                var cdatav = datas[current];
                $.ajax({
                    type: "POST",
                    url: "upload.php",
                    data: { new_one_p: new_one, new_question_p: new_question, current_p: current, data_p:cdatav}
                 }).done(function( msg ) {
                    location.reload();
                 });
            }
            
        </script>
    </head>
    <body>
        <div id='game'>
        </div>
        <script>
            build(0);
        </script>
    </body>
</html>