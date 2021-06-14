<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g stroke-miterlimit="10" :fill="_secondaryfill" :stroke="_secondaryfill"><line fill="none" stroke-linecap="round" stroke-linejoin="round" x1="1" y1="15.5" x2="15" y2="15.5" :stroke="_secondaryfill"></line> <polygon fill="none" stroke-linecap="round" stroke-linejoin="round" points="10.5,0.5 13.5,3.5 5,12 1,13 2,9 " :stroke="fill"></polygon> <line fill="none" stroke-linecap="round" stroke-linejoin="round" x1="8.5" y1="2.5" x2="11.5" y2="5.5" :stroke="fill"></line> </g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>