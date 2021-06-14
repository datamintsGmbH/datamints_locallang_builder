<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#009D39" d="M2,6h28L0,26V8C0,6.896,0.895,6,2,6z"></path> <path fill="#D90E2B" d="M46,42H18l30-20v18C48,41.104,47.105,42,46,42z"></path> <path fill="#161616" d="M37.211,6H46c1.105,0,2,0.896,2,2v9.193L10.789,42H2c-1.105,0-2-0.896-2-2v-9.193L37.211,6z"></path> <polygon fill="#F4CE01" points="48,22 18,42 10.789,42 48,17.193 "></polygon> <polygon fill="#F4CE01" points="30,6 37.211,6 0,30.807 0,26 "></polygon> <path fill="#FFFFFF" d="M12.367,32.684H9.42L8.184,30l-1.238,2.684H4l2.152,2.227l-0.797,3.23l2.828-1.605l2.828,1.605l-0.797-3.23 L12.367,32.684z"></path> <path fill="#FFFFFF" d="M44,12.543h-2.947l-1.236-2.684l-1.238,2.684h-2.945l2.152,2.227L36.988,18l2.828-1.605L42.645,18 l-0.797-3.23L44,12.543z"></path></g></svg></template>

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