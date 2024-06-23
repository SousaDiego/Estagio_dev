<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Estágio em Desenvolvimento </title>
  <link rel="stylesheet" href="formata-formulario.css">
</head>

<body>
 <h1> Cadastro e listagem de produtos </h1>
 <form action="desafio-estagio.php" method="post">

  <fieldset>
   <legend> Estoque - cadastro de dados - produto 1 </legend>

   <label class="alinha"> Nome do produto: </label>
   <input type="text" name="produto1" placeholder="Forneça o nome do produto..." autofocus> <br>

   <label class="alinha"> Descrição do produto: </label>
   <input type="text" name="descricao1"> <br>

   <label class="alinha"> Valor do produto: </label>
   <input type="number" name="preco1" min="0"  step="0.01"> <br>

   <label class="alinha"> Disponível para venda: </label>
   <input type="radio" name="disponivel1" value="Sim"> Sim
   <input type="radio" name="disponivel1" value="Não"> Não
  </fieldset>

  <fieldset>
  <legend> Estoque - cadastro de dados - produto 2 </legend>

   <label class="alinha"> Nome do produto: </label>
   <input type="text" name="produto2" placeholder="Forneça o nome do produto..."> <br>

   <label class="alinha"> Descrição do produto: </label>
   <input type="text" name="descricao2"> <br>

   <label class="alinha"> Valor do produto: </label>
   <input type="number" name="preco2" min="0"  step="0.01"> <br>

   <label class="alinha"> Disponível para venda: </label>
   <input type="radio" name="disponivel2" value="Sim"> Sim
   <input type="radio" name="disponivel2" value="Não"> Não
  </fieldset>

  <fieldset>
  <legend> Estoque - cadastro de dados - produto 3 </legend>

   <label class="alinha"> Nome do produto: </label>
   <input type="text" name="produto3" placeholder="Forneça o nome do produto..."> <br>

   <label class="alinha"> Descrição do produto: </label>
   <input type="text" name="descricao3"> <br>

   <label class="alinha"> Valor do produto: </label>
   <input type="number" name="preco3" min="0"  step="0.01"> <br>

   <label class="alinha"> Disponível para venda: </label>
   <input type="radio" name="disponivel3" value="Sim"> Sim
   <input type="radio" name="disponivel3" value="Não"> Não
  </fieldset>

  <button name="enviar"> Cadastrar e processar dados no estoque </button>
 </form> 

 <?php
  if(isset($_POST['enviar']))
   {
   //recebendo os dados dos três produtos do formulário   
   $produto1 = $_POST['produto1'];
   $produto2 = $_POST['produto2'];
   $produto3 = $_POST['produto3'];

   $descricao1 = $_POST['descricao1'];
   $descricao2 = $_POST['descricao2'];
   $descricao3 = $_POST['descricao3'];

   $preco1 = $_POST['preco1'];
   $preco2 = $_POST['preco2'];
   $preco3 = $_POST['preco3'];

   $disponivel1 = $_POST['disponivel1'];
   $disponivel2 = $_POST['disponivel2'];
   $disponivel3 = $_POST['disponivel3'];

   //criar a matriz de estoque
   $estoque = [ 
    $produto1 => [ 'descricao' => $descricao1, 'preco' => $preco1, 'disponivel' => $disponivel1],
    $produto2 => [ 'descricao' => $descricao2, 'preco' => $preco2, 'disponivel' => $disponivel2],
    $produto3 => [ 'descricao' => $descricao3, 'preco' => $preco3, 'disponivel' => $disponivel3]
              ];

   // Ordenar os produtos pelo preço
   usort($estoque, function($a, $b) {
       return $a['preco'] <=> $b['preco'];
   });

   echo "<table>
          <caption> Relação de produtos cadastrados </caption>
          <tr>
           <th> Produto </th>
           <th> Descrição </th>
           <th> Preço de venda </th>
           <th> Disponível para venda </th>
          </tr>";

   foreach($estoque as $produto => $dados)
    {
    echo "<tr>
           <td> $produto </td>
           <td> {$dados['descricao']} </td>
           <td> {$dados['preco']} </td>
           <td> {$dados['disponivel']} </td>
          </tr>";
    }

   echo "</table>";

   $menorPreco = min(array_column($estoque, 'preco'));
   $produtoMaisBarato = array_search($menorPreco, array_column($estoque, 'preco'));
   

   foreach($estoque as $nome => $dados) {
       if ($dados['preco'] == $menorPreco) {
           $produtoMaisBarato = $nome;
           $descricaoMaisBarato = $dados['descricao'];
           break;
       }
   }

   echo '<form action="desafio-estagio.php" method="post">
           <button type="submit">Cadastrar novo produto</button>
         </form>';
   }
 ?>
</body>
</html>
