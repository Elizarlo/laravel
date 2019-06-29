@extends ('principal')
@section ('contenido')

<template v-if="menu==0">
  <h2> Contenido del menu principal</h2>
</template>

<template v-if="menu==1">
    <categoria></categoria>
</template>

<template v-if="menu==2">
  <h2> Contenido del menu 2</h2>
</template>

<template v-if="menu==3">
  <h2> Contenido del menu 3</h2>
</template>


<template v-if="menu==4">
  <h2> Contenido del menu 4</h2>
</template>

<template v-if="menu==5">
  <h2> Contenido del menu 5</h2>
</template>

<template v-if="menu==6">
  <h2> Contenido del menu 6</h2>
</template>

<template v-if="menu==7">
  <h2> Contenido del menu 7</h2>
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
