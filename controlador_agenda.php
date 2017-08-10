<?php
//função criada para cadastrar algum novo contato;
function cadastrar($nome,$email,$telefone){
    //busca o arquivo "contatos.json", decodifica e mostra na tela todos os contatos;
    $contatosAuxiliar = pegarContatos();
    //a $contato pega os dados enviados atraveś do formulário.
    $contato = [
        'id'      => uniqid(),
        'nome'    => $nome,
        'email'   => $email,
        'telefone'=> $telefone
    ];
    //array_push pega a $contato e a coloca em $contatosAuxiliar, que é o arquivo "contatos.json" decodificado;
    array_push($contatosAuxiliar, $contato);
    //Atualizar arquivo;
    atualizarArquivo($contatosAuxiliar);
}
//Função pegarContatos pega os contatos do arquivo contatos.json;
function pegarContatos($valor_buscado = null){
    if ($valor_buscado == null){
        //Pega os arquivos de "contatos.json";
        $contatosAuxiliar = file_get_contents('contatos.json');
        //decodifica o arquivo;
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);
        //retorna o arquivo;
        return $contatosAuxiliar;
    } else {
        return buscarContato($valor_buscado);
    }
}
//Função para caso o admin queira excluir os contatos;
function excluirContato($id){
     //Chama a função para pegar os contatos;
    $contatosAuxiliar = pegarContatos();
    //Para cada item do contatoAuxiliar, busco os dados em sua posição;
    foreach ($contatosAuxiliar as $posicao => $contato){
    //Se a a variável ID do contato for IDentica a variável ID que estou procurando ele realiza esse processo;
        if($id == $contato['id']) {
    //para excluir os dados pela ID;
            unset($contatosAuxiliar[$posicao]);
        }
    }
    atualizarArquivo($contatosAuxiliar);
}
//Função para editar o contato;
function editarContato($id){
    //Pegar contatos;
    $contatosAuxiliar = pegarContatos();
    //Para cada parametro de contatoAuxiliar como contato;
    foreach ($contatosAuxiliar as $contato){
     //Se e o ID do contato for o mesmo ID que estou procurando, realiza esse processo
        if ($contato['id'] == $id){
     //vai retornar os contatos com os seus proprios dados que irão aparecer em outro arquivo;
            return $contato;
        }
    }
}
//salva o contato que foi editado;
function salvarContatoEditado($id){
    //Pegar os contatos;
    $contatosAuxiliar = pegarContatos();
    //Para cada contatoAuxiliar como a posição do contato;
    foreach ($contatosAuxiliar as $posicao => $contato){
    //Se o ID do contato for o mesmo que o ID que estou procurando realiza esse processo;
        if ($contato['id'] == $id){
        //edita os dados do contato;
            $contatosAuxiliar[$posicao]['nome'] = $_POST['nome'];
            $contatosAuxiliar[$posicao]['email'] = $_POST['email'];
            $contatosAuxiliar[$posicao]['telefone'] = $_POST['telefone'];
            break;
        }
    }
    //Atualiza o arquivo;
    atualizarArquivo($contatosAuxiliar);
}
//Função para Atualizar o arquivo;
function atualizarArquivo($contatosAuxiliar){
    //o arquivo "contatos.json" é codificado novamente;
    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
    //recebe todos os dados de usuário no arquivo "contatos.json" e substitui os dados que haviam anteriormente;
    file_put_contents('contatos.json', $contatosJson);
    //Redireciona para página inicial;
    header("Location: index.phtml");
}
//buscar um contato pelo nome;
function buscarContato($nome){
    //Pegar os contatos;
    $contatosAuxiliar = pegarContatos();
    $contatosEncontrados = [];
    //Para cada contatoAuxiliar como a posição do contato;
    foreach ($contatosAuxiliar as $contato){
        //Se o ID do contato for o mesmo que o ID que estou procurando realiza esse processo;
        if ($contato['nome'] == $nome){
            //retorna para o usuario o contato com seus dados prescritos;
            $contatosEncontrados[] = $contato;
        }
    }
    return $contatosEncontrados;
}
//ROTAS
switch($_GET['acao']){
    case "cadastrar":
    cadastrar($_POST['nome'],$_POST['email'],$_POST['telefone']);
        break;
    case "editar":
        salvarContatoEditado($_POST['id']);
        break;
    case "excluir":
        excluirContato($_GET['id']);
        break;
}