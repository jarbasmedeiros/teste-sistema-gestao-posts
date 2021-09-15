<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-md-2 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Novo Post</h5>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="">Título</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           aria-describedby="titleHelpInline" value="{{ old('title') }}" name="title">
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Descrição</label>
                                <div class="input-group">
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                    name="description" aria-label="With textarea" value="{{ old('description') }}"></textarea>
                                </div>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">URL da imagem</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('image_url') is-invalid @enderror"
                                           aria-describedby="image_urldHelpInline" value="{{ old('image_url') }}"
                                           name="image_url">
                                </div>
                                @error('image_url')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a class="btn btn-secondary mt-2 mb-2" href="{{ route('posts.index') }}" role="button">Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
