@extends('layouts.master')

@section('content')
    <style>
        [v-cloak] { display: none }
    </style>

    <div id="rest-client" v-cloak>
        <h1 class="text-center">@{{ message }}</h1>

        
        <div class="panel panel-info" v-for="item in items">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @{{ item.title }}
                        <a href="#!" class="pull-right" v-on:click="deleteItem(item)">
                            X
                        </a>
                        <a href="#!" class="pull-right" v-on:click="editItem(item)">
                            Edit&nbsp;
                        </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <a v-bind:href="item.link" target="_blank">@{{ item.link }}</a>
                    
                    <div class="panel panel-default" v-if="showEditForm(item)">
                        <div class="panel-body">

                        <form action="/items" method="POST" class="form-horizontal" role="form" v-on:submit.prevent="putItem">

                            <!--<input type="hidden" name="_METHOD" value="PUT"/>-->
                            
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title" class="form-control" value="" required="required" title="" v-model="editedItem.title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link" class="col-sm-2 control-label">Link:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="link" id="link" class="form-control" value="" required="required" title="" v-model="editedItem.link">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>
        </div>
        

        <hr>

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="/items" method="POST" class="form-horizontal" role="form" v-on:submit.prevent="postItem">

                    <!--<input type="hidden" name="_METHOD" value="PUT"/>-->
                    
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="" required="required" title="" v-model="newItem.title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link" class="col-sm-2 control-label">Link:</label>
                        <div class="col-sm-10">
                            <input type="text" name="link" id="link" class="form-control" value="" required="required" title="" v-model="newItem.link">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        @{{ editedItem }}
    </div>

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Vue.js -->
    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>

    <script>
        Vue.http.options.root = '/items';
        Vue.http.headers.common['X-CSRF-TOKEN'] = "{!! csrf_token() !!}";

        var app = new Vue({
            el: '#rest-client',
            data: {
                message: 'Source list',
                items: [],
                newItem: {
                    title: '',
                    link: ''
                },
                editedItem: null
            },
            computed: {

            },
            methods: {
                showEditForm: function(item) {
                    if (this.editedItem === null) return false;
                    return this.editedItem.id === item.id;
                },
                editItem: function(item) {
                    if (this.editedItem) {
                        this.editedItem = null;
                        return;
                    }
                    this.editedItem = item;
                },
                getItems: function() {
                    this.$http.get('/items').then(response => {
                        this.items = response.body;
                    });
                },
                postItem: function() {
                    this.$http.post('/items', this.newItem).then(function() {
                        this.getItems();
                        this.newItem.title = "";
                        this.newItem.link = "";
                    });
                },
                deleteItem: function(item) {
                    this.$http.delete('/items/' + item.id).then(function() {
                        this.getItems();
                    });
                },
                putItem: function() {
                    this.$http.put('/items/' + this.editedItem.id, this.editedItem).then(function() {
                        this.editedItem = null;
                        this.getItems();
                    });
                }
            }
        });

        app.getItems();
    </script>

@endsection
