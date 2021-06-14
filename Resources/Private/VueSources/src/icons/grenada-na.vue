<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D50F28" d="M46,6H2C0.896,6,0,6.896,0,8v32c0,1.104,0.896,2,2,2h44c1.104,0,2-0.896,2-2V8C48,6.896,47.104,6,46,6z M42,36H6V12h36V36z"></path> <rect x="6" y="12" fill="#FFCA1C" width="36" height="24"></rect> <path fill="#007B56" d="M18,24c0-1.231,0.373-2.375,1.01-3.327L6,12v24l13.01-8.673C18.373,26.375,18,25.231,18,24z"></path> <path fill="#007B56" d="M30,24c0-1.231-0.373-2.375-1.01-3.327L42,12v24l-13.01-8.673C29.627,26.375,30,25.231,30,24z"></path> <circle fill="#D50F28" cx="24" cy="24" r="6"></circle> <rect x="22" y="38" fill="#FFCA1C" width="4" height="2"></rect> <rect x="14" y="38" fill="#FFCA1C" width="4" height="2"></rect> <rect x="30" y="38" fill="#FFCA1C" width="4" height="2"></rect> <rect x="22" y="8" fill="#FFCA1C" width="4" height="2"></rect> <rect x="14" y="8" fill="#FFCA1C" width="4" height="2"></rect> <rect x="30" y="8" fill="#FFCA1C" width="4" height="2"></rect> <path fill="#E7CE02" d="M28.248,22.466h-2.992L24,19.743l-1.256,2.723h-2.992l2.186,2.262l-0.809,3.279L24,26.376l2.871,1.631 l-0.808-3.279L28.248,22.466z"></path></g></svg></template>

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