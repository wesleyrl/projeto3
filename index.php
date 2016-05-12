<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html"/>
    <meta name="generator" content="Bootply">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/rateit.css" type="text/css">
</head>
<body>
<header class="navbar navbar-default" role="banner">
        <div class="container">
                <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        <a href="index.php" class="navbar-brand">Home</a>
                    </div>
                <nav class="collapse navbar-collapse" role="navigation">
                        <ul class="nav navbar-nav">
                                <li>
                                   <a href="#">Lista de Clientes</a>
                                 </li>
                            </ul>
                    </nav>
            </div>
    </header>

<?php

require_once('src/config.inc.php');


use \SON\Pessoa\Type\Pfisica as Pfisica;
use \SON\Pessoa\Type\Pjuridica as Pjuridica;

$pf1 = new Pfisica('Jose Carloa','jose@gmail.com','(61) 8832-1299','Qr 122', 'Brasilia','DF','02183431213',5);

$pf2 = new Pfisica('Manuel Silva','manuel@gmail.com','(61) 3321-1299','RUA MARTINS','Rio de Janeiro', 'RJ','00183489913',3,'Rua tal n 4');

$pf3 = new Pfisica('Flavia Santos','flavinha@gmail.com','(61) 3321-2211','QNO 13','Samambaia','DF','00183489913',4);

$pf4 = new Pfisica('Antonio Freitas','antoniof@gmail.com','(11) 3322-1299','QND 32','Taguatinga', 'DF','00183329913',2);

$pf5 = new Pfisica('Monica Gomes','monicao@hotmail.com','(61) 6653-3321','RUA 32','Recanto','DF','00183489122',4,'SIA TRECHO 3 LT 19');

$pj1 = new Pjuridica('CERVEJARIA BEBOSEMPRE','bebosempre@gmail.com','(61) 3321-1299','SQWS 409','taguatinga','DF','12283489922122',3);

$pj2 = new Pjuridica('Paulo Silva Advogados','paulos@gmail.com','(61) 2133-1299','QNM 32','Santa Maria', 'DF','32183489433321',3,'setor de chacaras sul');

$pj3 = new Pjuridica('Felipe Chaves DESIGN','fchaves@gmail.com','(11) 8832-5231','QR N 322','SAMAMBAIA','DF','33343489211',4);

$pj4 = new Pjuridica('PIZZARIA ZEBU','zebu@gmail.com','(11) 1233-3322','SQLW 409','ASA SUL', 'DF','33283321211332',5,'702 NORT LJ 3');

$pj5 = new Pjuridica('JOAOZINHO CARNE DE SOL','josaozinhosol@gmail.com','(61) 8832-1299','QNO 12','LAGO NORTE','DF','33283329211332',2.5);

$ArrClientes = array($pf1, $pj1, $pf2, $pj2, $pf3, $pj3, $pf4, $pj4, $pf5, $pj5);

$ord = filter_input(INPUT_GET, 'ordena');
$ordena = (!empty($ord) ? $ord : 'asc');

if($ordena == 'asc'):
    arsort($ArrClientes);

else:
    sort($ArrClientes);

endif;
$usuarios =  new ArrayObject($ArrClientes);

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel">
                    <div class="panel-body">

                        <div class="panel-group">
                            <div class="panel-heading">

                                <a href="index.php?ordena=desc" title="Valor" class="btn btn-sm btn-warning pull-right">Ordem crescente </a>
                                <a href="index.php?ordena=asc" title="Valor" class="btn btn-sm btn-sm btn-success pull-right">Ordem decrescente </a>


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th><a href="#" class="blue"><i class="glyphicon glyphicon-user"> Clientes</i></a></th>
                                            <th><a href="#" class="blue"><i class="glyphicon glyphicon-check"> Categoria</i></a></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($usuarios as $keys => $values):
                                        $doc = ($values->getCategoria() == 'Pessoa Fisica' ? $values->getCpf() : $values->getCnpj());
                                        $catDoc = ($values->getCategoria() == 'Pessoa Fisica' ? "Cpf:" : "Cnpj:");
                                    ?>
                                        <tr>
                                            <td>
                                                <a href="#<?php  echo $keys; ?>"  data-toggle="collapse"> <small class="green"><i class="glyphicon glyphicon-circle-arrow-down"></i></small> <?php echo $values->getNome(); ?></a>
                                                <div id="<?php  echo $keys; ?>" class="collapse">
                                                    <hr>
                                                    <p><b><?php echo $catDoc?> </b><?php  echo $doc; ?></p>
                                                    <p><b>Email: </b><?php echo  $values->getEmail(); ?></p>
                                                    <p><b>Telefone: </b><?php echo  $values->getTelefone(); ?></p>
                                                    <p><b>Endereco: </b><?php echo  $values->getEndereco(); ?> </p>
                                                    <p><b> Cidade: </b><?php echo  $values->getCidade(); ?> - <?php echo  $values->getEstado(); ?>  </p>
                                                    <p><b>Endereco de Cobrança: </b><?php echo  $values->getEndCobranca(); ?></p>
                                                    <p>
                                                       <b>Importância:</b> <div class="rateit" data-rateit-value="<?php echo $values->getClassificacao(); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                    </p>
                                                </div>
                                                <hr>

                                            </td>
                                            <td>
                                                <a href="#>"  data-toggle="collapse"><?php echo $values->getCategoria(); ?></a>
                                            </td>

                                        </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <script>
        $('.votoCliente').rating(function(){});
    </script>

</body>
</html>
