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
        use SON\fixtures\Fixtures as fixtures;

        /*
          $pf1 = new Pfisica('Jose Carloa', 'jose@gmail.com', '(61) 8832-1299', 'Qr 122', 'Brasilia', 'DF', '02183431213', 5);

          $pf2 = new Pfisica('Manuel Silva', 'manuel@gmail.com', '(61) 3321-1299', 'RUA MARTINS', 'Rio de Janeiro', 'RJ', '00183489913', 3, 'Rua tal n 4');

          $pf3 = new Pfisica('Flavia Santos', 'flavinha@gmail.com', '(61) 3321-2211', 'QNO 13', 'Samambaia', 'DF', '00183489913', 4);

          $pf4 = new Pfisica('Antonio Freitas', 'antoniof@gmail.com', '(11) 3322-1299', 'QND 32', 'Taguatinga', 'DF', '00183329913', 2);

          $pf5 = new Pfisica('Monica Gomes', 'monicao@hotmail.com', '(61) 6653-3321', 'RUA 32', 'Recanto', 'DF', '00183489122', 4, 'SIA TRECHO 3 LT 19');

          $pj1 = new Pjuridica('CERVEJARIA BEBOSEMPRE', 'bebosempre@gmail.com', '(61) 3321-1299', 'SQWS 409', 'taguatinga', 'DF', '12283489922122', 3);

          $pj2 = new Pjuridica('Paulo Silva Advogados', 'paulos@gmail.com', '(61) 2133-1299', 'QNM 32', 'Santa Maria', 'DF', '32183489433321', 3, 'setor de chacaras sul');

          $pj3 = new Pjuridica('Felipe Chaves DESIGN', 'fchaves@gmail.com', '(11) 8832-5231', 'QR N 322', 'SAMAMBAIA', 'DF', '33343489211', 4);

          $pj4 = new Pjuridica('PIZZARIA ZEBU', 'zebu@gmail.com', '(11) 1233-3322', 'SQLW 409', 'ASA SUL', 'DF', '33283321211332', 5, '702 NORT LJ 3');

          $pj5 = new Pjuridica('JOAOZINHO CARNE DE SOL', 'josaozinhosol@gmail.com', '(61) 8832-1299', 'QNO 12', 'LAGO NORTE', 'DF', '33283329211332', 2.5);

          $ArrClientes = array($pf1, $pj1, $pf2, $pj2, $pf3, $pj3, $pf4, $pj4, $pf5, $pj5);

          $form_dados = filter_input_array(INPUT_POST);
          if($form_dados && $form_dados['cad_pessoa'])
          {
          extract($form_dados);
          if($categoria == 1)
          {

          $pessoa = new Pfisica($nome,$email,$telefone,$endereco,$cidade,$estado,$documento,(int)$classificacao,$endereco_cobrar);

          }
          elseif ($categoria == 2) {
          $pessoa = new Pjuridica($nome,$email,$telefone,$endereco,$cidade,$estado,$documento,(int)$classificacao,$endereco_cobrar);
          }
          var_dump($pessoa);
          array_push($ArrClientes,$pessoa);
          }


* 
         */

   
         
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
                                    <button type="button" class="btn btn-sm btn-sm btn-info pull-left" data-toggle="modal" data-target="#myModal">Adicionar</button>


                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>

                                                <th><a href="#" class="blue"><i class="glyphicon glyphicon-user"> Clientes</i></a></th>
                                                <th><a href="#" class="blue"><i class="glyphicon glyphicon-check"> Categoria</i></a></th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $fix = new fixtures();
                                            $ord = filter_input(INPUT_GET, 'ordena');
                                            $ordena = (!empty($ord) ? $ord : 'asc');
                                            foreach ($fix->getAllClientes($ordena) as $values):
                                                $doc = ($values['categoria'] == '1' ? "CPF:" : "CNPJ:");
                                                $catDoc = ($values['categoria'] == '1' ? "Pessoa Fisica:" : "Pessoa Juridica:");
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="#<?php echo $values['id']; ?>"  data-toggle="collapse"> <small class="green"><i class="glyphicon glyphicon-circle-arrow-down"></i></small> <?php echo $values['nome']; ?></a>
                                                        <div id="<?php echo $values['id']; ?>" class="collapse">
                                                            <hr>
                                                            <p><b><?php echo $doc ?> </b><?php echo $values['documento'] ?></p>
                                                            <p><b>Email: </b><?php echo $values['email']; ?></p>
                                                            <p><b>Telefone: </b><?php echo $values['telefone']; ?></p>
                                                            <p><b>Endereco: </b><?php echo $values['endereco']; ?> </p>
                                                            <p><b> Cidade: </b><?php echo $values['cidade']; ?> - <?php echo $values['estado']; ?>  </p>
                                                            <p><b>Endereco de Cobrança: </b><?php echo $values['endCobranca']; ?></p>
                                                            <p>
                                                                <b>Importância:</b> <div class="rateit" data-rateit-value="<?php echo $values['classificacao']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                            </p>
                                                        </div>
                                                        <hr>

                                                    </td>
                                                    <td>
                                                        <a href="#>"  data-toggle="collapse"><?php echo $catDoc; ?></a>
                                                    </td>

                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                    <div id="returnCadastro"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!--MODAL-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Adicionar Cliente</h4>
                    </div>
                    <div class="modal-body">


                        <form name="form_pessoa" action="" method="post">
                            <div class="row">
                                <div class="form-group col-lg-4 col-ms-4">
                                    <label for="categoria">Categoria</label>
                                    <select class="form-control" name="categoria">
                                        <option value="1">Pessoa Fisíca</option>
                                        <option value="2">Pessoa Juridica</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-7 col-ms-6 pull-right">
                                    <label for="nome" data-toggle="tooltip" data-placement="top" title="Informe o CPF para pessoa fisíca ou CNPJ para pessoa juridica"><i class="glyphicon glyphicon-alert"></i> Documento:</label>
                                    <input type="text" tabindex="1" class="form-control" placeholder="N° do documento cpf ou cnpj" name="documento" required>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="form-group col-lg-8 col-ms-8">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Informe o nome" required>
                                </div>

                                <div class="form-group col-lg-4 col-ms-4 pull-right">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" placeholder="N° do telefone" name="telefone" required>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="form-group col-lg-12 col-ms-12">
                                    <label for="nome">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="Informe o seu e-mail exemplo@dominio.com" required>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="form-group col-lg-8 col-ms-8">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" placeholder="Informe a cidade" required>
                                </div>

                                <div class="form-group col-lg-4 col-ms-4 pull-right">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control" placeholder="estado" name="estado" maxlength="2" required>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="form-group col-lg-12 col-ms-12 has-success has-feedback">
                                    <label for="endereco">Endereço</label>
                                    <input type="text"  class="form-control" name="endereco" placeholder="Informe o seu endereço" required>

                                </div>
                            </div><!--end row-->

                            <div class="row">
                                <div class="form-group col-lg-6 col-ms-6">
                                    <label for="classificacao">Classificação do cliente 1 à 5</label>
                                    <input type="number" class="form-control" min="1" max="5" name="classificacao" id="val_classificar">
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="form-group col-lg-12 col-ms-12">
                                    <label for="endereco">Endereço de cobrança</label>
                                    <input type="text" class="form-control" name="endereco_cobrar" placeholder="Informe o seu endereço para cobrança">
                                </div>
                            </div><!--end row-->
                            <input type="submit" class="btn btn-success" name="cad_pessoa" value="cadastrar">

                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.rateit.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        <script src="js/funcoes_insert.js"></script>
        <script>
            $('.votoCliente').rating(function () {});
        </script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        



    </body>
</html>
