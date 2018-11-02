    @if(Auth::check())
        @if(Auth::user()->idRol !== 3)
            @extends('principal')
                @section('contenido')
                    @if (Auth::user()->idRol == 1)
                    <template v-if="menu==0">
                    <user></user>
                    </template>

                    <template v-if="menu==1">
                        <producto></producto>
                    </template>                    
                    <template v-if="menu==2">
                        <categoria></categoria>
                    </template> 
                    <template v-if="menu==3">
                        <user></user>
                    </template>

                    <template v-if="menu==4">
                        <rol></rol>
                    </template>
                    <template v-if="menu==5">
                        <component-venta></component-venta>
                    </template>

                    <template v-if="menu==11">
                        <h1>Ayuda</h1>
                    </template>

                    <template v-if="menu==12">
                        <h1>Acerca de</h1>
                    </template>
                    @endif     
                @endsection 
        @endif 
        
    @endif 