<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3C3C3C" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V24h48V40z"></path> <path fill="#D21E29" d="M48,24H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#FFFF00" d="M36,36.357L27.135,28.1c0.497-0.402,0.974-0.842,1.406-1.342c1.92-2.225,2.86-5.062,2.646-7.992 c-0.214-2.932-1.557-5.602-3.781-7.523l-1.307,1.516c1.819,1.57,2.918,3.756,3.094,6.152c0.175,2.398-0.594,4.721-2.165,6.539 c-0.417,0.482-0.877,0.906-1.366,1.279L18.438,20l-1.363,1.463l6.772,6.307c-3.081,1.357-6.798,0.953-9.513-1.391l-1.307,1.516 c2.075,1.791,4.634,2.668,7.182,2.668c1.806,0,3.6-0.453,5.217-1.322l9.212,8.58L36,36.357z"></path> <path fill="#FFFF00" d="M24.256,12.648h-2.908L20.128,10l-1.222,2.648H16l2.124,2.193l-0.786,3.189l2.79-1.584l2.79,1.584 l-0.786-3.189L24.256,12.648z"></path></g></svg></template>

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