<script setup>
// variable

defineProps(['title','description','priority','created_at']);

</script>

<template>
    <div class="w-full lg:w-1/3 p-3">
        <div
            class="flex flex-col rounded overflow-hidden h-auto lg:h-32 border shadow shadow-lg" >  
            <div  class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col  leading-normal">
                <div class="text-black font-bold text-xl mb-2 leading-tight flex justify-between" >
                 <p>   {{ title }}</p> <p>#{{ priority }}</p>
                </div>
                <p class="text-grey-darker text-base">
                    {{description}}
                </p>
            </div>
            <p class="text-right text-sm mt-auto pe-2">{{created_at}}</p>
        </div>
    </div>
</template>
