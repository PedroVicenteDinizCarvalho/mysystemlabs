# mysystemlabs
Teste de conhecimento - Plataforma de aulas de Karatê

Para acessar direto pelo site: http://karate-system.herokuapp.com/
    1 - Você pode criar usuário com permissão de aluno normalmente pelo formulário de registro.
     *Caso queira logar como um aluno já existente, deixei um registro feito.
        Email: jose@karate.com
        Senha: clubedalutaZW
    2 - Para logar como professor, deixei dois professores já registrados pelo seeder.
            Quer ser o Jackie Chan? Então use:
                Email: jackie@karate.com
                Senha: clubedalutaZW 
            Quer ser o Lyoto Machida? Então use:
                Email: lyoto@karate.com
                Senha: clubedalutaZW 

Para instalar o projeto em seu PC:

 1 - Rode o comando " git clone https://github.com/PedroVicenteDinizCarvalho/mysystemlabs.git "
 2 - Depois de baixado o pacote do projeto. Execute " composer install "
 3 - Execute " php artisan key:generate "
 4 - No arquivo .env 
    *LINHA 11: preencha as informações corretas de seu banco de dados
    *LINHA 34: configure sua conta do mailtrap para fazer os disparos de email corretamente
 5 - Agora rode o comando " php artisan migrate "
 6 - Para popular o BD " php artisan db:seed "
 7 - Por fim para rodar o projeto " php artisan serve "
 8 - Você pode criar usuário com permissão de aluno normalmente pelo formulário de registro.
     *Caso queira logar como um aluno já existente, deixei um registro feito.
        Email: jose@karate.com
        Senha: clubedalutaZW
 9 - Para logar como professor, deixei dois professores já registrados pelo seeder.
        Quer ser o Jackie Chan? Então use:
            Email: jackie@karate.com
            Senha: clubedalutaZW 
        Quer ser o Lyoto Machida? Então use:
            Email: lyoto@karate.com
            Senha: clubedalutaZW 

OBS: Não criei um módulo administrador para gerenciar professores e alunos pois este projeto foi feito para fim de testes de conhecimento. Mas você pode contribuir sempre que quiser ;)
 
