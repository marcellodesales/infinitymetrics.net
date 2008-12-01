<?php
/**
 * @author Brett
 */

include '../template/infinitymetrics-bootstrap.php';

$temp = false;

#----->>>>>>>>>>>>> Controller Usage for ***** ------------------>>>>>>>>>>>>>>>

require_once 'infinitymetrics/controller/CustomEventController.class.php';
require_once 'infinitymetrics/model/workspace/Project.class.php';
require_once 'infinitymetrics/model/InfinityMetricsException.class.php';

if (isset($_POST["notes"]) && isset($_POST["title"])) {

    try {
        $temp = CustomEventController::createEvent($_POST['notes'],$_POST['title'],$_GET['project_jn_name'],$_GET['parent_project_jn_name']);
        $_SESSION["successMessage"] = "Data entry successful!";
    }
    catch (Exception $e) {
        $_SESSION["Data entry error."] = $e;
    }
}

#------------>>>>>>>>>>>>> Variables Initialization ------------->>>>>>>>>>>>>>>



    $subUseCase = "Add Custom Event";
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="js" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>Infinity Metrics: <?php echo $subUseCase; ?></title>

<?php include 'static-js-css.php';  ?>
<?php include 'user-signup-header-adds.php' ?>
    </head>
    <body class="<?php /*echo $enableLeftNav ? $leftNavClass : $NoLeftNavClass;*/ ?>">
<?php  include 'top-navigation.php';  ?>

    <table align=center>
    <tbody align=center><tr align=center><td align=center><b>
    <?php echo $_GET['project_jn_name'] ?>
    </b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody>
    </table>

    <!--div id="breadcrumb" class="alone">
    <h2 id="title">Home</h2>
    <div class="breadcrumb"-->

<?php
   /* $totalBreadscrum = count(array_keys($breakscrum)); $idx = 0;
    foreach (array_keys($breakscrum) as $keyUrl) {
        echo "<a href=\"" . $keyUrl . "\"> " . $breakscrum[$keyUrl] . "</a> ".
        (++$idx < $totalBreadscrum ? "» " : " ");
    }*/
?>

</div></div> <!-- Strange unneeded /divs for PHP -->

<?php
    if (isset($_SESSION["Data entry error."]) && $_SESSION["Data entry error."] != "") {
        echo "<div class=\"messages error\">".$_SESSION["Data entry error."]."</div>";
        $_SESSION["Data entry error."] = "";
        unset($_SESSION["Data entry error."]);
    }
?>

<?php
        if (isset($_SESSION["successMessage"]) && $_SESSION["successMessage"] != "") {
             echo "<div class=\"messages ok\">".$_SESSION["successMessage"]."</div>";
             $_SESSION["successMessage"] = "";
             unset($_SESSION["successMessage"]);
        }
?>

<div id="content-wrap">
    <form id="createcustomevent" autocomplete="off" method="post" action="<?php echo $PHP_SELF."?project_jn_name=".$_GET['project_jn_name']."&parent_project_jn_name=".$_GET['parent_project_jn_name']."&workspace_id=".$_GET['workspace_id'] ?>">
  
        <table align="center">
            <tbody>
                <tr>
                    <td class="status" width="30">&nbsp;</td>
                    <td class="label" width="20"><label id="ltitle" for="title">Title</label></td>
                    <td class="field"><input id="title" name="title" class="textfield" value="" maxlength="50" type="text"></td>
	  		    </tr>
                <tr>
                    <td class="status" width="30">&nbsp;</td>
                    <td class="label" width="20"><label id="lnotes" for="notes">Notes</label></td>
                    <td class="field"><input id="notes" name="notes" class="textfield" value="" maxlength="50" type="text"></td>
	  		    </tr>
                <tr>
                    <td colspan="2">
                        <input id="edit-submit" value="OK" class="form-submit" type="submit">
                        <p>
                        <input id="edit-delete" value="Cancel" class="form-submit" type="button" onclick="document.location= <?php echo "'viewCustomEvents.php?workspace_id=".$_GET['workspace_id']."'" ?>">
                    </td>
                </tr>
	  		</tbody>
        </table>


    </form>
</div>

</div> <!-- Strange unneeded /div for PHP -->

<?php include 'footer.php';   ?>