# wordpress-plugin
Brand Lovers Word Press Plugin


## Instalação
- [Manual](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation)

## Configuração
Após ativar o plugin, o mesmo poderá ser configurado na opção ```Settings > BL Comments```

## Utilização
Para inserir os comentários, deverá ser utilizado o ```shortcode``` com a marcação ```[bl-comments]```

- Exemplo:

```
[bl-comment data-mode="reviews" data-productid="521a38a6ef2bfc38b7a9d6af"]
```

## Atributos
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Obrigatório</th>
            <th>Descrição</th>
            <th>Grupo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>data-mode</td>
            <td>Sim</td>
            <td>
                <p>Modo de visualização dos comentários.</p>
                <strong>Produto</strong>
                <ul>
                    <li>action-shot</li>
                    <li>reviews</li>
                    <li>wheretobuy</li>
                </ul>
                <strong>Usuário</strong>
                <ul>
                    <li>user-posts</li>
                </ul>
            </td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-productid</td>
            <td>Sim</td>
            <td>Identificado único do produto</td>
            <td>Produto</td>
        </tr>
        <tr>
            <td>data-comment</td>
            <td>Não</td>
            <td>Opção para definir se o plugin irá exibir àrea para postagem de comentários</td>
            <td>Produto</td>
        </tr>
        <tr>
            <td>data-color</td>
            <td>Não</td>
            <td>Cor de fundo do plugin</td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-width</td>
            <td>Não</td>
            <td>Largura do componente em px</td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-num-comments</td>
            <td>Não</td>
            <td>Quantidade de comentários que serão exibidos</td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-show-profile-face</td>
            <td>Não</td>
            <td>Opção para definir se será exibido as fotos dos usuários</td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-font-color</td>
            <td>Não</td>
            <td>Cor da font dos comentários</td>
            <td>Produto, Usuário</td>
        </tr>
        <tr>
            <td>data-email</td>
            <td>Sim</td>
            <td>Email do usuário que será exibido os comentários</td>
            <td>Usuário</td>
        </tr>
    </tbody>
</table>

