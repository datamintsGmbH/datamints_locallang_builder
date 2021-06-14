<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0D8643" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFCE19" d="M31.573,17.537C31.827,18.318,32,19.135,32,20c0,4.418-3.582,8-8,8s-8-3.582-8-8 c0-0.865,0.173-1.682,0.427-2.463C14.935,19.285,14,21.523,14,24c0,5.523,4.478,10,10,10c5.522,0,10-4.477,10-10 C34,21.523,33.065,19.285,31.573,17.537z"></path> <path fill="#FFCE19" d="M28.185,16.543h-2.948L24,13.859l-1.237,2.684h-2.947l2.153,2.227L21.173,22L24,20.395L26.827,22 l-0.796-3.23L28.185,16.543z"></path></g></svg></template>

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