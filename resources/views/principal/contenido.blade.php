@extends ('principal')
@section ('contenido')

<template v-if="menu==0">
  <example-component> </example-component>
</template>

<template v-if="menu==1">
    <categoria></categoria>
</template>

<template v-if="menu==2">
  <articulo></articulo>
</template>

<template v-if="menu==3">
  <ingreso></ingreso>
</template>

<template v-if="menu==4">
  <proveedor></proveedor>  
</template>

<template v-if="menu==5">
  <venta></venta>
</template>

<template v-if="menu==6">
  <persona></persona>
</template>

<template v-if="menu==7">
  <usuario></usuario>
</template>

<template v-if="menu==8">
  <rol></rol>
</template>


<template v-if="menu==9">
  <h2> Contenido del menu 9</h2>
</template>

<template v-if="menu==10">
  <h2> Contenido del menu 10</h2>
</template>

<template v-if="menu==11">
  <h2> Contenido del menu 11</h2>
</template>
  
  <template v-if="menu==12">
  <h2> Contenido del menu 12</h2>
</template>



  

@endsection
