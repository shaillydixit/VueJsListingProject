<template>
    <Box >
      <div>
          <Link :href="route('listing.show', {listing: listing.id})">
            <div class="flex items-center gap-1">
                <ListingPrice :price="listing.price" class="text-2xl font-bold" />
                <div class="text-xs text-gray-500">
                    <ListingPrice :price="monthlyPayment" /> pm
                </div>
            </div>
               <ListingSpace :listing="listing" class="text-lg"/>
               <ListingAddress :listing="listing" class="text-gray-500"/>
        </Link>
      </div>
      <div>
        <!-- <Link :href="route('listing.edit', {listing: listing.id})" as="button">Edit</Link>&nbsp; -->
          <!-- <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>    -->
      </div>
    </Box>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingPrice from '@/Components/ListingPrice.vue'
import Box from '@/Components/UI/Box.vue'

import {useMonthlyPayment} from '@/Composables/useMonthlyPayment'

const props = defineProps({ listing: Object })
const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)
</script>