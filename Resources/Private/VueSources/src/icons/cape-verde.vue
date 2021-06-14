<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#2E3094" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <rect y="32" fill="#FFFFFF" width="48" height="2"></rect> <rect y="30" fill="#D1142A" width="48" height="2"></rect> <rect y="28" fill="#FFFFFF" width="48" height="2"></rect> <path fill="#2E3094" d="M48,28H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V28z"></path> <path fill="#E8D313" d="M16.145,21.299h-1.461l-0.611-1.33l-0.613,1.33H12l1.066,1.1L12.672,24l1.4-0.795l1.4,0.795l-0.394-1.602 L16.145,21.299z"></path> <path fill="#E8D313" d="M16.145,35.33h-1.461L14.072,34l-0.613,1.33H12l1.066,1.1l-0.395,1.602l1.4-0.795l1.4,0.795l-0.394-1.602 L16.145,35.33z"></path> <path fill="#E8D313" d="M20.912,24.9l-1.051-1.016l0.486-1.383l-1.367,0.531l-1.051-1.012l0.004,1.531l-1.395,0.879l1.559,0.398 l0.455,1.547l0.828-1.428L20.912,24.9z"></path> <path fill="#E8D313" d="M11.166,34.992l-1.051-1.014l0.484-1.383l-1.365,0.531l-1.051-1.014l0.004,1.531l-1.397,0.879l1.561,0.4 l0.453,1.545l0.828-1.428L11.166,34.992z"></path> <path fill="#E8D313" d="M21.84,30.803l-0.051-1.461l1.313-0.656l-1.354-0.568l-0.053-1.459l-1.063,1.105l-1.613-0.336l0.846,1.367 l-0.748,1.43l1.588-0.451L21.84,30.803z"></path> <path fill="#E8D313" d="M7.82,31.291l-0.053-1.459l1.311-0.658l-1.352-0.566l-0.053-1.459l-1.061,1.104l-1.617-0.336l0.848,1.371 l-0.75,1.426l1.588-0.451L7.82,31.291z"></path> <path fill="#E8D313" d="M18.406,35.693l0.981-1.088l1.398,0.44l-0.578-1.348l0.977-1.086l-1.533,0.057l-0.928-1.361l-0.34,1.57 l-1.531,0.508l1.453,0.777L18.406,35.693z"></path> <path fill="#E8D313" d="M7.984,26.305l0.975-1.086l1.4,0.435l-0.578-1.344l0.973-1.086l-1.527,0.055l-0.93-1.363L7.953,23.49 l-1.529,0.504l1.455,0.779L7.984,26.305z"></path></g></svg></template>

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