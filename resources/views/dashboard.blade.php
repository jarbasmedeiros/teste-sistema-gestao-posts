<x-app-layout>
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <strong>Posts<strong>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm" style="float: right;">Novo
                            Post</a>
            </div>
            <div id="alert" class="m-2 mt-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($userPosts)
                    @foreach ($userPosts as $post)
                        <div class="col-4">
                            <div class="card-group mt-3">
                                <div class="card mb-2">
                                    <img src="{{ $post->image_url }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group">
                                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                class="btn btn-secondary btn-sm">Editar</a>&nbsp;
                                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button id="del" type="submit"  data-name="name"
                                                    class="btn btn-sm btn-danger delete-confirm">Remover</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="m-3">
                        <h4>Voc?? ainda n??o tem posts publicados.</h4>
                    </div>
                @endif
            </div>
            <div class="mt-3 mb-3">{{ $userPosts->links() }}</div>
        </div>
    </div>
</x-app-layout>
