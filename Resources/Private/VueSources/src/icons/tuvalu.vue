<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M46,6H2A2,2,0,0,0,0,8V40a2,2,0,0,0,2,2H46a2,2,0,0,0,2-2V8A2,2,0,0,0,46,6Z" fill="#4ba7e3"></path> <path d="M2,6H24a0,0,0,0,1,0,0V24a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V8A2,2,0,0,1,2,6Z" fill="#00017a"></path> <polygon points="19 19 16 19 16 19.25 22.333 24 24 24 24 22.75 19 19" fill="red"></polygon> <path d="M.12,7.34,5,11H8v-.25L1.706,6.03A1.991,1.991,0,0,0,.12,7.34Z" fill="red"></path> <polygon points="24 6 22.334 6 16 10.75 16 11 19.001 11 24 7.25 24 6" fill="red"></polygon> <polygon points="0 22.75 0 24 1.667 24 8 19.25 8 19 5 19 0 22.75" fill="red"></polygon> <polygon points="24 13 14 13 14 6 10 6 10 13 0 13 0 17 10 17 10 24 14 24 14 17 24 17 24 13" fill="red"></polygon> <path d="M34.018,21.344H32.332l-.708-1.537-.708,1.537H29.231l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path> <path d="M40,17.537H38.314L37.606,16,36.9,17.537H35.213l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path> <path d="M45.018,12.03H43.332l-.708-1.537-.708,1.537H40.231l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path> <path d="M33,34.851H31.314l-.708-1.537L29.9,34.851H28.213l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path> <path d="M38.982,31.044H37.3l-.708-1.537-.708,1.537H34.2l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path> <path d="M44,25.537H42.314L41.606,24,40.9,25.537H39.213l1.231,1.27-.455,1.85,1.617-.918,1.617.918-.455-1.85Z" fill="#f6d031"></path></g></svg></template>

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