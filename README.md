# PHP-Session-Class

Classe para gerenciar sessões.

Gerencia o tempo de duração da Sessão.

A sessão é renovada automaticamente a cada nova validação. 

Caso o prazo expire a sessão é destruida e o usuário redirecionado para o endereço configurado na classe.


## Description of PHPClass.org

This package provides a wrapper class to manage sessions.

It can create a session with a given name and perform other operations to manage information stored in session data during its lifetime. Currently it can:

- Determine if a valid session was started and redirect to a logout page when it is not valid
- Destroy a session and clearing respective session cookie
- Display the values of session variable values in the pages

[php-class](https://www.phpclasses.org/package/11476-PHP-Wrapper-class-to-manage-sessions.html)
