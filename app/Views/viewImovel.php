<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>WebMudança</title>
    <link rel="stylesheet" href="../../../m/public/Css/viewImovel.css">
</head>

<body>

    <header>
        <nav id="nav">
            <a href="<?= base_url('/') ?>"><img class="logo" src="../../../m/public/img/logo.png" alt="WebMudança LOGO"></a>
            <ul>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li><a href="<?= base_url('/') . "#carousel"; ?>">Imoveis</a></li>
                <li><a href="#pesq-sobre">Sobre</a></li>
                <li><a href="#infos">Suporte</a></li>
                <li><a href="#infos">Contatos</a></li>
                <li id="login"><a href="<?= base_url('login'); ?>">Entrar</a></li>
            </ul>
        </nav>

    </header>

    <main>

       
            <div class="fotos">
            <img src=" <?= "../../../m/public/uploads/" . $imovel[0]['Imagens']?>" alt="">
            </div>
            
            <div class="valor">
            <img src="../../../m/public/icons/money (1).png"  alt=""> <p><p><?= "R$ " . $imovel[0]['Preco']?></p></p>
            </div>

            <div class="maisInformacoes">
                <h2>VER MAIS CARACTERÍSTICAS</h2>
                <img src="../../../m/public/img/Sem título.png" alt="">
            </div>
            <div class="informacoes">
                                        <ul>
                                            <li><img src="../../../m/public/icons/area (1).png" alt="Area">Área
                                                <hr>
                                                <p><?=$imovel[0]['Area']?></p>
                                            </li>
                                            <li><img src="../../../m/public/icons/double-bed.png" alt="Quantidade Quartos">Quartos
                                                <hr>
                                                <p><?=$imovel[0]['NumeroQuartos']?></p>
                                            </li>
                                            <li><img src="../../../m/public/icons/bathroom.png" alt="Quantidade Banheiros">Banheiros
                                                <hr>
                                                <p><?=$imovel[0]['NumeroBanheiros']?></p>
                                            </li>
                                            <li><img src="../../../m/public/icons/garage.png" alt="Vagas Garagem">Vagas Garagem
                                                <hr>
                                                <p><?=$imovel[0]['NumeroVagasGaragem']?></p>
                                            </li>
                                        </ul>
        </div>
   

        

     
       
      

    </main>

</body>

</html>