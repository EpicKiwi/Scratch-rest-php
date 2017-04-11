<!DOCTYPE html>
<html>
<head>
    <title>Gestion des utilisateurs</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css"/>
    <link rel="stylesheet" href="/static/bootstrap.css"/>
    <link rel="stylesheet" href="/static/style.css"/>
</head>
<body>

<div class="container main-page">
    <div class="jumbotron">
        <h1 class="display-3">Gestion des utilisateurs</h1>
        <div class="lead">Gèrez vos utilisateurs avec une API REST</div>
    </div>
    <table class="table list-users" id="list-users">
        <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            <th class="list-users--status">Statut</th>
            <th class="list-users--actions">Actions</th>
        </tr>
        </thead>
        <tbody id="list-users-body">
        </tbody>
        <tbody id="list-users-body">
            <form id="new-user-form" >
                <tr class="list-user--user">
                    <td><input id="user-input-username" type="text" placeholder="Nom d'utilisateur" class="form-control"></td>
                    <td><input id="user-input-email" type="email" placeholder="Email" class="form-control"></td>
                    <td><input id="user-input-role" type="text" placeholder="Rôle" class="form-control"></td>
                    <td class="list-users--status">
                        <select id="user-input-active" type="text" class="form-control">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </td>
                    <td class="list-users--actions" style="line-height: 38px">
                        <button class="btn btn-success btn-sm action-button" title="Ajouter"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>

<div class="loading-screen screen" id="loading">
    <div class="screen--content">
        <div class="loading-screen--spinner"><i class="fa fa-circle-o-notch" aria-hidden="true"></i></div>
        <div class="loading-screen--loading">Chargement</div>
    </div>
</div>

<div class="edit-screen screen is-hidden" id="edit-lightbox">
    <div class="edit-screen--content screen--content">
        <form id="edit-user-submit">
            <h3>Editer l'utilisateur</h3>
            <input type="hidden" id="edit-user-id">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" class="form-control" id="edit-user-username"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="edit-user-email"/>
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <input type="text" class="form-control" id="edit-user-role"/>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select id="user-input-active" class="form-control" id="edit-user-status">
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>
            </div>
            <button class="btn btn-primary action-button">Valider</button>
        </form>
    </div>
</div>

<table class="template"><tbody class="template" id="user-line-template">
    <tr class="list-user--user" id="user-{{id}}" data-user-id="{{id}}">
        <td>{{username}}</td>
        <td>{{email}}</td>
        <td>{{role}}</td>
        <td class="list-users--status">{{status}}</td>
        <td class="list-users--actions">
            <div class="btn btn-danger btn-sm action-button list-users--delete-button" title="Supprimer" data-user-id="{{id}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
            <div class="btn btn-sm btn-primary action-button list-users--edit-button" title="Modifier" data-user-id="{{id}}"><i class="fa fa-pencil" aria-hidden="true"></i></div>
        </td>
    </tr>
</tbody></table>

<script src="/static/mustache.js"></script>
<script src="/static/jquery.js"></script>
<script src="/static/app.js"></script>
</body>
</html>