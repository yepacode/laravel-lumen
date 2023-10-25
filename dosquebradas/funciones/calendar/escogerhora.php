<html> 
<head> 
<title>Escoger Hora</title> 
  <SCRIPT language="javascript1.5" type="text/javascript">
<!--Script para que la pagina se recarge y obtener actualizacion de campos que dependen de otros-->

       function ColocarHora(){ 
            var varHora=document.forms['frmHora']['lstHora'].value + ":" + document.forms['frmHora']['lstMinutos'].value + ":00" 
            opener.document.forms['frm_programacion_de_recogidas'][<?=$id;?>].value = varHora; 
            opener.document.forms['frm_programacion_de_recogidas'][<?=$id;?>].select() 
            opener.document.forms['frm_programacion_de_recogidas'][<?=$id;?>].focus() 
            close(); 
       } 
  </SCRIPT> 

  <link href="../hojas_estilo/top_frame.css" rel="stylesheet" type="text/css">
  <link href="../intranet/css/main.css" rel="stylesheet" type="text/css">
  <link href="../../intranet/css/main.css" rel="stylesheet" type="text/css">
</head> 

<body> 
<form name="frmHora" method="post" action=""> 
  <table width="132" border="1" class="box"> 
    <tr> 
      <td width="100%"><table width="100%"  border="0"> 
        <tr> 
          <td width="50%" ><select name="lstHora" class="camposdatos" id="lstHora"> 
            <option value="01">01</option> 
            <option value="02">02</option> 
            <option value="03">03</option> 
            <option value="04">04</option> 
            <option value="05">05</option> 
            <option value="06">06</option> 
            <option value="07">07</option> 
            <option value="08">08</option> 
            <option value="09">09</option> 
            <option value="10">10</option> 
            <option value="11">11</option> 
            <option value="12">12</option> 
            <option value="13">13</option> 
            <option value="14">14</option> 
            <option value="15">15</option> 
            <option value="16">16</option> 
            <option value="17">17</option> 
            <option value="18">18</option> 
            <option value="19">19</option> 
            <option value="20">20</option> 
            <option value="21">21</option> 
            <option value="22">22</option> 
            <option value="23">23</option> 
            <option value="24">24</option> 
          </select> 
          :</td> 
          <td width="50%"><select name="lstMinutos" class="camposdatos" id="lstMinutos"> 
            <option value="01">01</option> 
            <option value="02">02</option> 
            <option value="03">03</option> 
            <option value="04">04</option> 
            <option value="05">05</option> 
            <option value="06">06</option> 
            <option value="07">07</option> 
            <option value="08">08</option> 
            <option value="09">09</option> 
            <option value="10">10</option> 
            <option value="11">11</option> 
            <option value="12">12</option> 
            <option value="13">13</option> 
            <option value="14">14</option> 
            <option value="15">15</option> 
            <option value="16">16</option> 
            <option value="17">17</option> 
            <option value="18">18</option> 
            <option value="19">19</option> 
            <option value="20">20</option> 
            <option value="21">21</option> 
            <option value="22">22</option> 
            <option value="23">23</option> 
            <option value="24">24</option> 
            <option value="25">25</option> 
            <option value="26">26</option> 
            <option value="27">27</option> 
            <option value="28">28</option> 
            <option value="29">29</option> 
            <option value="30">30</option> 
            <option value="31">31</option> 
            <option value="32">32</option> 
            <option value="33">33</option> 
            <option value="34">34</option> 
            <option value="35">35</option> 
            <option value="36">36</option> 
            <option value="37">37</option> 
            <option value="38">38</option> 
            <option value="39">39</option> 
            <option value="40">40</option> 
            <option value="41">41</option> 
            <option value="42">42</option> 
            <option value="43">43</option> 
            <option value="44">44</option> 
            <option value="45">45</option> 
            <option value="46">46</option> 
            <option value="47">47</option> 
            <option value="48">48</option> 
            <option value="49">49</option> 
            <option value="50">50</option> 
            <option value="51">51</option> 
            <option value="52">52</option> 
            <option value="53">53</option> 
            <option value="54">54</option> 
            <option value="55">55</option> 
            <option value="56">56</option> 
            <option value="57">57</option> 
            <option value="58">58</option> 
            <option value="59">59</option> 
            <option value="60">60</option> 
            </select> 
          </td> 
        </tr> 
      </table></td> 
    </tr> 
  </table> 
  <table width="100%"  border="0"> 
    <tr> 
      <td height="40" align="center" valign="bottom"><input name="btnAceptar" type="button" id="btnAceptar" value="Aceptar"  onClick="ColocarHora()"></td>
    </tr> 
  </table> 
</form> 
</body> 
</html>  
