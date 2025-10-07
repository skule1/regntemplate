
<h1>
    <?php echo $this->msg; ?>
</h1>

<?php
$user = JFactory::getUser();
$username = $user->username;
if ($username)
    echo '<h5>Klient: ' . $user->username . '<br></h5>';
?>



<script>
    window.addEventListener('DOMContentLoaded', function() {
        console.log('addEventListener');
        const lastTab = localStorage.getItem('lastTab');
        if (lastTab) {
            console.log('lastTab', lastTab);
            const element = document.getElementById(lastTab);
            if (element) {
                console.log('element', element);
                element.scrollIntoView({
                    behavior: 'smooth'
                }); // or element.focus()
                // You can also programmatically trigger tab activation if you're using Bootstrap or similar
                // Example for Bootstrap Tabs:
                // new bootstrap.Tab(document.querySelector(`#${lastTab}`)).show();
            }
            localStorage.removeItem('lastTab'); // optional: clear after use
        }
    });


    function ch(a,br) {
        console.log('ch', a,br);
     //   return;
        if (event.key == 'Insert') {
            console.log('enter');
            //  window.location.reload();

            // //      let nr = document.getElementById(nr + "rap").value
            // let tekst = document.getElementById(a + "tekst").value
            // let niva = document.getElementById(a + "niva").value
            // let mode = "vanlig";
            // console.log('change ', a, tekst, niva, event.key);
            // if (event.key == 'Enter') window.location.reload();
            // else if (event.key == 'Insert') mode = "Insert";
            // else if (event.key == 'Delete') mode = "Delete";
            //      document.getElementById('openFormBtn').addEventListener('click', () => {
            // Create modal container
            const modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '0';
            modal.style.left = '0';
            modal.style.width = '100vw';
            modal.style.height = '100vh';
            modal.style.backgroundColor = 'rgba(78, 58, 110, 0.5)';
            modal.style.display = 'flex';
            modal.style.justifyContent = 'center';
            modal.style.alignItems = 'center';
            modal.innerHTML = `
    <div style="background: white; padding: 20px; border-radius: 10px;">
    
       <form id="userForm" ><table>
          <tr><td>Nr: </td><td><input type="number" id="nrr" name="nr" /></td></tr>
          <tr><td>Tekst: </td><td><input type="text" name="tekst" /></td></tr>
         <tr><td>Nivå:</td><td><input type="number" name="niva" /></td></tr>
          <tr><td></td><td><button type="submit">Oppdater</button><button type="button" id="cancelForm">Cancel</button></td></tr>
              </table>
        </form>
    </div>
  `;

            document.body.appendChild(modal);
            document.getElementById("nrr").focus();
            // Handle form submission
            document.getElementById('userForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const jsonData = {};
                for (const [key, value] of formData.entries()) {
                    jsonData[key] = value;
                }
                console.log("Form data as JSON:", jsonData);
                document.body.removeChild(modal); // Close modal
                obj = JSON.parse(JSON.stringify(jsonData));
                console.log('obj', obj);
                console.log('obj niva', obj['niva']);
                $.ajax({
                    //          jQuery.ajax({
                    type: "POST",
                    url: "index.php?option=com_regn&task=resmal.insertmal",
                    data: ({
                        nr: obj['nr'],
                        tekst: obj['tekst'],
                        niva: obj['niva'],
                        mode: 'Insert',
                        br:br
                    }),
                    cache: false,
                    success: function(tekst) {
                        console.log(tekst, obj, obj['nr']);

                        // function reloadAndSaveTab(obj['nr']+'tekst') {
                        //     localStorage.setItem('lastTab', tabId);
                     window.location.reload();
                        // }
                    }
                })
            });

            // Cancel button
            document.getElementById('cancelForm').addEventListener('click', () => {
                document.body.removeChild(modal); // Close modal
            });
            //    });
        } else {
            console.log('ch', a);
            let nr=a;
           // let nr = document.getElementById(nr + "rap").value
            let tekst = document.getElementById(nr + "tekst").value
            let niva = document.getElementById(nr + "niva").value
            let mode = "vanlig";
            console.log('change ', nr, tekst, niva, event.key);
            if (event.key == 'Enter') window.location.reload();
            else if (event.key == 'Insert') mode = "Insert";
            else if (event.key == 'Delete') mode = "Delete";


            $.ajax({
                //          jQuery.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=resmal.oppdat_mal",
                data: ({
                    nr: nr,
                    tekst: tekst,
                    niva: niva,
                    mode: mode,
                    br:br
                }),
                cache: false,
                success: function(tekst) {
                    console.log(tekst);
         //           window.location.reload();
                    //       document.getElementById(nr+"tekst").focus();
                }
            })



        }
    }

    function ch5(nr, mode) {
        let key = event.key;
        console.log('ch', key, nr, mode);

        $.ajax({
            //          jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=resmal.oppdat_func",
            data: ({
                nr: nr,
                key: key,
                mode: mode
            }),
            cache: false,
            success: function(tekst) {
                console.log(tekst);
                localStorage.setItem('lastTab', tabId);
                window.location.reload();

            }
        })

    }
</script>

<?php /** * @package Joomla.Administrator * @subpackage com_helloworld * * @copyright Copyright (C) 2005 - 2019 Open
    Source Matters, Inc. All rights reserved. * @license GNU General Public License version 2 or later; see LICENSE.txt
 */ // No direct access to this file defined('_JEXEC') or die('Restricted access'); include 'fc.php' ; 
?>
<?php
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;



$model = $this->getModel('resmal');
$mals = $model->hentmal();
$ktoer = $model->hentkto();

use Joomla\CMS\Helper\ModuleHelper;



if (isset($_GET['valg']))
    $mode = $_GET['valg'];
else
    $mode = 'R';

$mode1 = "B";

?>

<form action="" id="vlgform" method="GET" style=" margin-left: 20px;">

    <select onchange="fvalg()" name="valg" id="gg">
        <option value="R" <?php if ($mode == "R") echo "selected"; ?>>Resultat</option>
        <option value="B" <?php if ($mode == "B") echo "selected"; ?>>Balase</option>
        <option value="L" <?php if ($mode == "L") echo "selected"; ?>>Likvid</option>
        <option value="I" <?php if ($mode == "I") echo "selected"; ?>>Bilagsjournal</option>
        <option value="S" <?php if ($mode == "S") echo "selected"; ?>>Saldoliste</option>
        <option value="A" <?php if ($mode == "A") echo "selected"; ?>>Avgiftsoppgjør</option>
        <option value="D" <?php if ($mode == "D") echo "selected"; ?>>Dekingsbidrag</option>

    </select>

    <!-- <label for="fruits">Choose a fruit:</label>
<select id="fruits" name="fruits">
  <option value="apple">Apple</option>
  <option value="banana">Banana</option>
  <option value="cherry">Cherry</option>
</select>



<select7 name="fruits" multiple>
  <option value="apple">Apple</option>
  <option value="banana">Banana</option>
  <option value="cherry">Cherry</option>
</select>

<select name="food">
  <optgroup label="Fruits">
    <option value="apple">Apple</option>
    <option value="banana">Banana</option>
  </optgroup>
  <optgroup label="Vegetables">
    <option value="carrot">Carrot</option>
    <option value="broccoli">Broccoli</option>
  </optgroup>
</select>
 -->






    <table>
        <td style="vertical-align: top;" width="500">
            <?php

            $img = '<form  action=""><table><tr><th>Nr</th><th>Tekst</th><th>Nivå</th></th</tr>';
            foreach ($mals as $mal) {
                $r = trim( $mal->BR);

                if ($r == $mode)
                    //    $img = $img . '<tr><td>' . $mal->nr . '</td><td>' . $mal->tekst . '</td><td>' . $mal->niva . '</td></tr>';
                    // $img = $img . '<tr><td><input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'rap" onkeydown="ch(' . $mal->nr . ',\"' . $r . '\")"  value="' . $mal->nr . '"></td><td>'
                    //     . '<input style="text-align:left;width:160px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'tekst" onkeydown="ch(' . $mal->nr . ',\"' . $r . '\")" onchange="ch(' . $mal->nr . ',\"' . $r . '")"  value="' . $mal->tekst . '"></td><td>'
                    //     . '<input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'niva" onchange="ch(' . $mal->nr . ',\"' . $r . '\")"  value="' . $mal->niva . '"></td></tr>';
                $img = $img . '<tr><td><input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'rap" onkeydown="ch(' . $mal->nr . ',\'' . $r . '\')"  value="' . $mal->nr . '"></td><td>'
                    . '<input style="text-align:left;width:160px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'tekst" onkeydown="ch(' . $mal->nr . ',\''.$r.'\')" onchange="ch(' . $mal->nr . ',\'' . $r . '\')"  value="' . $mal->tekst . '"></td><td>'
                    . '<input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $mal->nr . 'niva" onchange="ch(' . $mal->nr . ',\'' . $r . '\')"  value="' . $mal->niva . '"></td></tr>';
            }

            $img = $img . '</table></form>';
            echo $img . '<br>';

            ?>
        </td>
        <td width="800">
            <?php
            //       $img1 = '<form><table><tr><th>Ktonr</th><th>Navn</th><th>Rap6</th><th>Rap1</th><th>Likv</th></tr>';
            $img1 = '<form><table><tr><th>Ktonr</th><th>Navn</th><th>Rapport</th></tr>';
            $kto = $ktoer[1];
            foreach ($ktoer as $kto) {
                if ($kto->ResBal == $mode) {
                    $img1 = $img1 . '<tr><td>' . $kto->Ktonr . '</td><td style="text-align:left;width:250px;" >' . $kto->Navn . '</td><td>'
                        //  . '</td><td><input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $kto->Ktonr . 'rap" onchange="ch(' . $kto->Ktonr . ')"  value="' . $kto->rapportlinje . '"></td><td>'
                        // . '</td><td><input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $kto->Ktonr . 'rap1" onchange="ch(' . $kto->Ktonr . ')"  value="' . $kto->Rapport1 . '"></td><td>'
                        // . '</td><td><input style="text-align:right;width:40px; border-width:0px; padding-right: 10px;" type="text" id="' . $kto->Ktonr . 'likv" onchange="ch(' . $kto->Ktonr . ')"  value="' . $kto->Likvid . '"></td><td>'

                        . ' <select style=" border-width:0px;" name="kat" id="' . $kto->Ktonr . 'sel1"  onchange="selectchange(' . $kto->Ktonr . ')" >';
                    foreach ($mals as $mal) {
                        if (($mal->BR == $mode) &&  ($mal->niva == 1)) {
                            if ($mal->nr == $kto->rapportlinje)
                                $img1 = $img1 . ' <option value="' . $mal->nr . '" selected>' . $mal->nr . ' ' . $mal->tekst . ' </option>';
                            else
                                $img1 = $img1 . ' <option value="' . $mal->nr . '" >' . $mal->nr . ' ' . $mal->tekst . ' </option>';
                        }
                    }
                    $img1 = $img1 . ' </select> </td>';
                }
            }












            $img1 = $img1 . '</tr></table>';
            echo $img1 . '<br>';
            ?>
        </td>

    </table>





    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        function fvalg() {
            console.log("valg");
            //   const vlg = document.getElementById("vlg").value;
            document.getElementById('vlgform').submit();
        }









        function selectchange(kto) {
            console.log('selectchange', kto);
            let rap = document.getElementById(kto + "sel1").value
            console.log('selectchange', kto + "sel1", rap);
            $.ajax({
                //          jQuery.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=resmal.oppdat_kto",
                data: ({
                    kto: kto,
                    rap: rap
                }),
                cache: false,
                success: function(tekst) {
                    console.log(tekst);
                    window.location.reload();
                    document.getElementById(nr + "tekst").focus();
                }
            })
        }



        function ch1(nr, mode) {
            let key = event.key;
            console.log('ch1', key, nr, mode);

            $.ajax({
                //          jQuery.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=resmal.oppdat_func",
                data: ({
                    nr: nr,
                    key: key,
                    mode: mode
                }),
                cache: false,
                success: function(tekst) {
                    console.log(tekst);
                    window.location.reload();
                    document.getElementById(nr + "tekst").focus();
                }
            })





        }


        function ch8(nr) {
            console.log('ch');
            //      let nr = document.getElementById(nr + "rap").value
            let tekst = document.getElementById(nr + "tekst").value
            let niva = document.getElementById(nr + "niva").value
            let mode = "vanlig";
            console.log('change ', nr, tekst, niva, event.key);
            if (event.key == 'Enter') window.location.reload();
            else if (event.key == 'Insert') mode = "Insert";
            else if (event.key == 'Delete') mode = "Delete";


            $.ajax({
                //          jQuery.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=resmal.oppdat_mal",
                data: ({
                    nr: nr,
                    tekst: tekst,
                    niva: niva,
                    mode: mode
                }),
                cache: false,
                success: function(tekst) {
                    console.log(tekst);
                    window.location.reload();
                    //       document.getElementById(nr+"tekst").focus();
                }
            })
        }



        //         function openFormWindow() {
        function ch3(ach) {
            const formHTML = `
        <html>
        <head><title>Form</title></head>
        <body>
          <form id="popupForm" action="">
            <label>Name: <input type="text" name="name"></label><br>
            <label>Email: <input type="text" name="email"></label><br>
            <button type="submit">Submit</button>
          </form>

          <script>
            document.getElementById('popupForm').addEventListener('submit', function(e) {
              e.preventDefault();
              const formData = new FormData(this);
              const data = Object.fromEntries(formData.entries());
              window.opener.postMessage(data, "*");
              window.close();
            });
          <\/script>
        </body>
        </html>
      `;

            const formWindow = window.open("", "FormWindow", "width=400,height=300");
            formWindow.document.write(formHTML);
        }

        window.addEventListener("message", (event) => {
            console.log("Received from popup:", event.data);
            // You can now use event.data.name or event.data.email
        });
    </script>