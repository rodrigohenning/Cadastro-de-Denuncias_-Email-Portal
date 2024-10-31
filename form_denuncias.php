<?php
/*
Autor: Rodrigo Henning C. Rodrigues
Email: rodrigohenning@hotmail.com
Data: 19/08/2019
Objetivo: Efetuar denuncias Denuncias por email pelo portal IMAC - 
**********************************************************************************

***********************************************************************************         
*/
ini_set('default_charset','UTF-8');
include('registro.php');

?>
<head>
    <script type="text/javascript" src="includes/js/jQuery.js"></script>
    <!-- <link href="includes/css/style.css" rel="stylesheet" type="text/css"  /> -->
    <link href="includes/css/bootstrap.css" rel="stylesheet" type="text/css"  />
    <title>Denúcias Portal IMAC</title>
</head>

<body>

  <script type="text/javascript">
  /* Máscaras ER */
  function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function mcpf(v){
    v=v.replace(/\D/g,"");  //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d{3})(\d{3})(\d{2})$/,"$1.$2.$3-$4");  //Coloca ponto hífen entre o dígitos do cpf
    return v;
}

function mcep(v){
    v=v.replace(/\D/g,"");  //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d{3})(\d{3})$/,"$1.$2-$3");  //Coloca ponto hífen entre o dígitos do cpf
    return v;
}

function minscricao(v){
    v=v.replace(/\D/g,"");  //Remove tudo o que não é dígito
    v=v.replace(/(\d{1})(\d{1})$/,"$1-$2");  //Coloca ponto hífen entre o dígitos do cpf
    return v;
}


function id( el ){
    return document.getElementById( el );
}
window.onload = function(){
    id('telefone').onkeyup = function(){
        mascara( this, mtel );
    }
    id('cpf').onkeyup = function(){
        mascara( this, mcpf );
    }
    id('cep').onkeyup = function(){
        mascara( this, mcep );
    }
}
</script>



<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript" language="javascript">
function valida_form (){
    if(document.getElementById("g-recaptcha-response").value.length < 1){
        document.getElementById("g-recaptcha-response").focus();
        alert('Campo captcha obrigatório');
        return false
    }
}
</script>


<script language="javascript">
function desabilita(y) {
    var nome;
    var cpf;
    var telefone;
    var cidade;
    var cep;
    var endereco;
    nome = document.getElementById("nome");
    cpf = document.getElementById("cpf");
    cidade = document.getElementById("cidade");
    telefone = document.getElementById("telefone");
    endereco = document.getElementById("endereco");
    cep = document.getElementById("cep");
    var jcpf = jQuery.noConflict();
    if (y==1) {
        nome.disabled = true;
        nome.value = "Denunciante Anônimo";
        cpf.disabled = true;
        cpf.value = "000.000.000-00";
        cidade.disabled = true;
        cidade.value = "Rio Branco";
        telefone.disabled = true;
        telefone.value = "(68)0000-0000";
        jcpf(document).ready(function(){
            jcpf("#cpf").removeClass("required");
            jcpf("#cpf").addClass("validate-ouvidoria_cpf");
        });
        // telefone.removeClass("required");
        cep = document.getElementById("cep");
        cep.disabled = true;
        cep.value = "69.000-000";
        endereco.disabled = true;
        endereco.value = "Sede IMAC";
    } else {
        nome.disabled = false;
        nome.value = "";
        cpf.disabled = false;
        cpf.value = "";
        jcpf(document).ready(function(){
            jcpf("#cpf").removeClass("cpf");
            jcpf("#cpf").addClass("required cpf");
        });
        cidade.disabled = false;
        cidade.value = "";
        telefone.disabled = false;
        telefone.value = "";
        cep = document.getElementById("cep");
        cep.disabled = false;
        cep.value = "";
        endereco.disabled = false;
        endereco.value = "";
    };   
}
</script>

<script language="javascript">
function especificar(y) {
    var degradaçãoEspecificada;
    degradaçãoEspecificada = document.getElementById("degradaçãoEspecificada");
    if (y==1) {
        degradaçãoEspecificada.disabled = true;
        degradaçãoEspecificada.value = "";
    } else {
        degradaçãoEspecificada.disabled = false;
        degradaçãoEspecificada.value = "";
    };   
}
</script>


<style type="text/css">
input.span12, textarea.span12{
    width: 100%;
}
.hero-unit {
    padding: 0px;
    margin-bottom: 0px;
}
.validate {
    margin-left: 32px;
    margin-right: 32px;
}
#cidade {
    max-width: 260px;
}       
</style>   

<form action="" method="POST" name="form_denuncia" id="contact_form" class="form-validate validate" onsubmit="return valida_form(this)" enctype="multipart/form-data">
    <fieldset>
        <legend>1. DADOS PESSOAIS DO DENUNCIANTE.</legend>  
        <div class="row-fluid">
            <div class="span12">
                <label class="radio" for=""><input type="radio" name="indentificacao" id="" value="1" class="required" onclick="desabilita(2);" aria-required="true" required="required" aria-invalid="false">Desejo me identificar, mas gostaria do sigilo dos meus dados pessoais</label>
                <label class="radio" for=""><input type="radio" name="indentificacao" id="" value="2" class="required" onclick="desabilita(1);" aria-required="true" required="required" aria-invalid="false">Não desejo me identificar</label><span></span>
                <br><br>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span5">
                <label for="">Nome Completo</label><input type="text" maxlength="50" name="nome" id="nome" class="span12 required" style="margin-left:0px" aria-required="true" required="required" disabled=""><span></span>
            </div>
            <div class="span2">
                <label for="">CPF</label><input type="text" name="cpf" id="cpf" maxlength="14" class="span12 validate-ouvidoria_cpf cpf" aria-required="true" required="required" disabled=""><span></span>
            </div>
            <div class="span3">
                <label for="">Email</label><input type="email" name="email" maxlength="50" id="email" class="span12 required email" aria-required="true" required="required"><span></span>
            </div>
            <div class="span2">
                <label for="">Telefone</label><input type="text" name="telefone" id="telefone" maxlength="15" class="span12 validate-ouvidoria_telefone " aria-required="true" disabled="" required="required"><span></span>
            </div>
        </div><br>
        <div class="row-fluid">
            <div class="span6">
               <label for="">Endereço</label><input type="text" maxlength="100" name="endereco" id="endereco" class="span12 required" style="margin-left:0px" aria-required="true" required="required" disabled=""><span></span>
           </div>
           <div class="span3">
            <label for="ouvidorialocalidade">Localidade</label>
            <select name="cidade" size="1" class="span12 required" id="cidade" aria-required="true" required="required" disabled="">
                <option value="">-- Selecione --</option>
                <option value="Acrelândia">Acrelândia</option>
                <option value="Assis Brasil">Assis Brasil</option>
                <option value="Brasiléia">Brasiléia</option>
                <option value="Bujari">Bujari</option>
                <option value="Capixaba">Capixaba</option>
                <option value="Cruzeiro do Sul">Cruzeiro do Sul</option>
                <option value="Epitaciolândia">Epitaciolândia</option>
                <option value="Feijó">Feijó</option>
                <option value="Jordão">Jordão</option>
                <option value="Manoel Urbano">Manoel Urbano</option>
                <option value="Marechal Thaumaturgo">Marechal Thaumaturgo</option>
                <option value="Mâncio Lima">Mâncio Lima</option>
                <option value="Plácido de Castro">Plácido de Castro</option>
                <option value="Porto Acre">Porto Acre</option>
                <option value="Porto Walter">Porto Walter</option>
                <option value="Rio Branco">Rio Branco</option>
                <option value="Rodrigues Alves">Rodrigues Alves</option>
                <option value="Santa Rosa do Purus">Santa Rosa do Purus</option>
                <option value="Sena Madureira">Sena Madureira</option>
                <option value="Senador Guiomard">Senador Guiomard</option>
                <option value="Tarauacá">Tarauacá</option>
                <option value="Xapuri">Xapuri</option>                            
            </select>
        </div>
        <div class="span3">
            <label for="">Cep</label><input type="text" name="cep" id="cep" maxlength="10" class="span12 validate-ouvidoria_cep required" aria-required="true"  disabled=""><span></span>
        </div>
    </div>
</fieldset><hr>




<fieldset>
    <legend>2. DADOS DO DENUNCIADO</legend>  
    <div class="row-fluid">
        <div class="span5">
            <label for="">Nome </label><input type="text" maxlength="50" name="nomeDenunciado" class="span12 required" style="margin-left:0px" aria-required="true" required="required" ><span></span>
        </div>
        <div class="span2">
            <label for="">Apelido </label><input type="text" maxlength="50" name="apelidoDenunciado" id="nome" class="span12 required" style="margin-left:0px" aria-required="true"><span></span>
        </div>

        <div class="span5">
            <label for="">Endereço </label><input type="text" name="endeDenunciado" maxlength="100" id="endeDenunciado" class="span12" style="margin-left:0px" aria-required="true"><span></span>
        </div>
    </div><br>

    <div class="row-fluid">
       <div class="span6">
        <label for="">Complemento </label>
        <input type="text" name="complementoDenunciado" maxlength="100" id="complementoDenunciado" class="span12" style="margin-left:0px" aria-required="true"><span></span>
    </div>
    <div class="span5">
        <label for="ouvidorialocalidade">Localidade</label>
        <select name="cidadeDenunciado" size="1" class="span12 required" id="cidadeDenunciado" aria-required="true" required="required">
            <option value="">-- Selecione --</option>
            <option value="Acrelândia">Acrelândia</option>
            <option value="Assis Brasil">Assis Brasil</option>
            <option value="Brasiléia">Brasiléia</option>
            <option value="Bujari">Bujari</option>
            <option value="Capixaba">Capixaba</option>
            <option value="Cruzeiro do Sul">Cruzeiro do Sul</option>
            <option value="Epitaciolândia">Epitaciolândia</option>
            <option value="Feijó">Feijó</option>
            <option value="Jordão">Jordão</option>
            <option value="Manoel Urbano">Manoel Urbano</option>
            <option value="Marechal Thaumaturgo">Marechal Thaumaturgo</option>
            <option value="Mâncio Lima">Mâncio Lima</option>
            <option value="Plácido de Castro">Plácido de Castro</option>
            <option value="Porto Acre">Porto Acre</option>
            <option value="Porto Walter">Porto Walter</option>
            <option value="Rio Branco">Rio Branco</option>
            <option value="Rodrigues Alves">Rodrigues Alves</option>
            <option value="Santa Rosa do Purus">Santa Rosa do Purus</option>
            <option value="Sena Madureira">Sena Madureira</option>
            <option value="Senador Guiomard">Senador Guiomard</option>
            <option value="Tarauacá">Tarauacá</option>
            <option value="Xapuri">Xapuri</option>                 
        </select>
    </div>
</div>
</fieldset><hr>




<fieldset>
    <legend>3. TIPO DE DEGRADAÇÃO AMBIENTAL. </legend>  
    <div class="row-fluid">   
        <!-- Multiple Checkboxes (inline) -->
        <div class="form-group">
          <div class="span12">
            <label class="checkbox-inline" for="checkboxes-0">
              <input type="checkbox" name="queima" id="checkboxes-0" value="1">
              Queimada
          </label>
          <label class="checkbox-inline" for="checkboxes-1">
              <input type="checkbox" name="desmate" id="checkboxes-1" value="1">
              Desmatamento Ilegal
          </label>
          <label class="checkbox-inline" for="checkboxes-2">
              <input type="checkbox" name="agua" id="checkboxes-2" value="1">
              Obstrução de Curso d´água 
          </label>
          <label class="checkbox-inline" for="checkboxes-3">
              <input type="checkbox" name="fauna" id="checkboxes-3" value="1">
              Danos a Fauna 
          </label>
      </div>
  </div>
</div>
<div class="row-fluid">
  <label><br>
      Outros Especificar?
      <label class="radio" for=""><input type="radio" name="Especificar" id="" value="1" class="required" onclick="especificar(2);" aria-required="true" required="required" aria-invalid="false">Sim</label>
      <label class="radio" for=""><input type="radio" name="Especificar" id="" value="2" class="required" onclick="especificar(1);" aria-required="true" required="required" aria-invalid="false" checked="checked">Não</label><span></span>
  </label>
  <div class="span5">
    <input type="text" maxlength="50" name="degradaçãoEspecificada" id="degradaçãoEspecificada" class="span12 required" style="margin-left:0px" aria-required="true" required="required" disabled=""><span></span>
</div>
</div>
</fieldset><hr>




<fieldset>
    <legend>3. NARRATIVA DA DENÚNCIA.</legend> 
    <div class="row-fluid">
        <div class="span12">
            <label for="">Informe a descrição detalhada, local, data, horário e periodicidade dos fatos ocorridos</label><textarea maxlength="3000" name="narrativa" id="narrativa" rows="5" class="span12 required" onkeyup="progreso_tecla(this,3000,'narr')" style="margin-left:0px" aria-required="true" required="required"></textarea>
            <div id="narr">0 caracter de 3000.</div><span></span>
        </div>
    </div>
</fieldset><hr>




<fieldset>
    <legend>4. INDÍCIOS DA SUPOSTA IRREGULARIDADE</legend>
    <div class="row-fluid">
        <label for="fileupload">Informe a existência de foto, vídeo, documento ou outras provas (jpg, png, jpeg, pdf) que
            evidenciem o(s) fato(s) denunciados(s). Obs.: Caso existam e sejam passíveis de envio por meio
            eletrônico, <strong>utilize a opção ANEXAR.</strong><br>
            <label class="label input persona" for='selecao-arquivo'>Anexar &#187;</label>
            <input  type="file" id="selecao-arquivo" name="arquivo" accept=".jpg, .png, .jpeg, .mp4, .pdf, .doc, .docx">
            <span id='file-name'></span>
        </label>
    </div>
</fieldset>
<script type="text/javascript">

$("#arquivo").change(function() {
    $(this).prev().html($(this).val());
});
</script>

<div class="row-fluid">
    <div class="span12">
        <p><br></p>
        <center>
            <div class="g-recaptcha" data-sitekey="6Lfwyy8fAAAAAKmVx0-NEEm2GGY6kx8qus3j7m5D"></div>
            <br/>
            <button type="submit" class="btn btn-large btn-success">Enviar Denúncia</button>
            
        </center>
        <p></p>
    </div>
</div>
</form>

<script type="text/javascript">
var ancho=300;
function progreso_tecla(obj,max,nome) {
    var progreso = document.getElementById(nome);
    if (obj.value.length < max) {
        var pos = ancho-parseInt((ancho*parseInt(obj.value.length))/max);
    }
    if (obj.value.length==0) {
        progreso.innerHTML = obj.value.length+" caracter de "+max+".";
    }else {         
        progreso.innerHTML = obj.value.length+" caracteres de "+max+".";
    };
}

var $input    = document.getElementById('selecao-arquivo'),
    $fileName = document.getElementById('file-name');

$input.addEventListener('change', function(){
  $fileName.textContent = this.value;
});
</script> 


</body>
