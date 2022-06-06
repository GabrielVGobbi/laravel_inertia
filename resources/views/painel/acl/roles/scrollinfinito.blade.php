@extends("layouts.painel")

@section('title', 'Funções')

@section('content')

    <div id="roles"></div>

    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>

@stop

@section('scripts')
    <script>
        let page = 1;
        const divRoles = document.querySelector('#roles');
        const loaderContainer = document.querySelector('.spinner-border')

        const getRoles = async () => {
            const response = await fetch(`http://www2.laratemplate.com.br/v2/roles?page=${page}`);
            return response.json();
        }

        const addRolesIntoDom = async () => {
            const roles = await getRoles();
            const rolesTemplate = roles.data.map((({
                name
            }) => `
                 <div class="card mt-4">
                    <div class="roles">
                        <div class="card-body">
                            <h2 class="">${name}</h2>
                        </div>
                    </div>
                </div> `)).join('')

            divRoles.innerHTML += rolesTemplate;
        }

        const getNextPosts = () => {
            page++;
            addRolesIntoDom();
        }

        addRolesIntoDom();

        window.addEventListener('scroll', () => {
            const {
                clientHeight,
                scrollHeight,
                scrollTop
            } = document.documentElement;

            const isPageBottomAlmostReached = scrollTop + clientHeight >= scrollHeight - 500;

            if (isPageBottomAlmostReached) {
                getNextPosts()
            }
        })

        //http://www2.laratemplate.com.br/v2/roles?page=1
    </script>
@endsection
