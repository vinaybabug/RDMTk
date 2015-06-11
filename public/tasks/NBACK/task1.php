<?php
error_reporting(1);
session_start();
ob_start();
$click = $_SESSION['sessionvalue'];
$list_data = $_SESSION['list_data'];
$experimentid = $_SESSION['exp'];
$participantid = $_SESSION['MID'];
$trials_atttempted = $_SESSION['trialattempted_pract'];
$currenttrial = $_GET['currenttrial'];
$_SESSION['dataparticipant'][$click]['trail'] = $click;
$_SESSION['prev_char'] = 0;
$initial_char = $list_data[$_SESSION['sessionvalue']]->score_values;
$_SESSION['dataparticipant'][$_SESSION['sessionvalue']]['stimuli'] = $initial_char;
$_SESSION['initial_char'] = $initial_char;
$previous_char_count = 0;

if ($click >= 3) {
    $previous_char_count = $click - 2;
    $prev_char = $list_data[$previous_char_count]->score_values;
    $_SESSION['prev_char'] = $prev_char;
    if ($prev_char == $initial_char) {
        $_SESSION['space'] = 1;
        $_SESSION['dataparticipant'][$click]['score'] = 2;
        $_SESSION['dataparticipant'][$click]['cor_res'] = 1;
    } else {
        $_SESSION['dataparticipant'][$click]['score'] = 4;
        $_SESSION['dataparticipant'][$click]['cor_res'] = 0;
        $_SESSION['dataparticipant'][$click]['response'] = 0;
    }
} else {
    $_SESSION['dataparticipant'][$click]['score'] = 4;
    $_SESSION['dataparticipant'][$click]['cor_res'] = 0;
    $_SESSION['dataparticipant'][$click]['response'] = 0;
}

$_SESSION['sessionvalue'] = $_SESSION['sessionvalue'] + 1;
?>
<div id="s_timer" style="display:none;">0<span>3</span>:00</div>
<?php echo $initial_char; ?>
<script>
    $(document).ready(function() {
        var char_present = "<?php echo $initial_char; ?>";
        var trails_attempted =<?php echo $trials_atttempted; ?>;
        var trails_no =<?php echo $_SESSION['sessionvalue']; ?>;
        if (trails_no > 3) {
            var prev_no = "<?php echo $prev_char; ?>";

        }
        var sec = 3;

        var timer = setInterval(function() {

            $('#s_timer span').text(sec--);
            if (sec == "-1") {
                if (trails_attempted >= trails_no) {
                    $.ajax({url: "task1.php", success: function(result) {
                            $("#main_card").html(result);
                            $("#main_card").css("font-size", "1100%");
                            $("#main_card").css("color", "black");
                            $("#main_card_main_test").css("font-size", "1100%");
                            $("#main_card_main_test").css("color", "black");
                            clearTimeout(timer);
                        }});
                }
                if (trails_attempted == trails_no) {
                    $.ajax({url: "final.php", success: function(result) {
                            $("#main_card").css('display', 'none');
                            $("#main_card_main_test").css('display', 'none');
                            $("#main_test_text").css('display', 'block');
                            $("#main_card_main_test").css("color", "black");

                        }});
                }
            }
        }, 300);
    });
</script>



