@extends('admin.wrapper')

{{-- Web site Title --}}
@section('title', 'Post')

@section('content')
    
    <div id="post">
        <md-card>
            <md-card-header class="md-toolbar ">
                <h2 class="md-title">Header</h2>
            </md-card-header>

            <md-card-content>
                
                <form>
                    <md-input-container>
                        <label>Input Test</label>
                        <md-input></md-input>
                    </md-input-container>

                    <md-input-container>
                        <label>Select Test</label>
                        <md-select>
                            <md-option value="1">Option 1</md-option>
                            <md-option value="2">Option 2</md-option>
                        </md-select>
                    </md-input-container>
                </form>

            </md-card-content>
        </md-card>
    </div>

@endsection