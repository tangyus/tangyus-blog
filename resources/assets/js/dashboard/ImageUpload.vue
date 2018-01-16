<template>
    <div id="image-upload">
        <el-upload
                class="upload-demo"
                ref="upload"
                :action="uploadAction"
                :headers="headers"
                :before-upload="uploadFile"
                :on-success="successHandle"
                :on-error="errorHandle"
                :limit="1"
                :file-list="fileList"
                :on-exceed="handleExceed"
                :auto-upload="false"
                list-type="picture"
                name="image">
            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/jpeg/png文件，且不超过500KB</div>
        </el-upload>
        <el-alert
                v-if="uploadErrorMessage.length > 0"
                v-for="item in uploadErrorMessage"
                title=""
                type="error">
            {{item}}
        </el-alert>
    </div>
</template>

<script>
    export default {
        props: {
            image_path: {
                type: String
            },
            files: {
                type: Array
            },
            upload_type: {
                type: String
            }
        },
        data() {
            return {
                uploadErrorMessage: []
            }
        },
        computed: {
            headers() {
                return {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            uploadAction() {
                return '/upload/' + this.upload_type;
            },
            // 由于props数据只能单向从父组件到子组件，故定义一个计算属性接收父组件传递来的数据
            fileList() {
                return this.files;
            }
        },
        methods: {
            /**
             * 上传文件
             */
            submitUpload() {
                this.$refs.upload.submit();
            },
            /**
             * 文件上传之前，检查文件格式和大小
             * @param file
             * @returns {boolean}
             */
            uploadFile(file) {
                if (file.size > 500 * 1024) {
                    this.$message({
                        message: '请上传小于500KB的图片',
                        type: 'error',
                        showClose: true
                    });
                    return false;
                }
                if (file.type != 'image/jpeg') {
                    this.$message({
                        message: '请上传jpg/jpeg/png格式的图片',
                        type: 'error',
                        showClose: true
                    });
                    return false;
                }
            },
            /**
             * 超出文件上传限制
             */
            handleExceed() {
                this.$message({
                    message: '最多只能上传一张图片',
                    type: 'error',
                    showClose: true
                });
            },
            /**
             * 上传成功
             * @param response 返回信息
             * @param file 文件信息
             * @param fileList
             */
            successHandle(response, file, fileList) {
                if (response.success) {
                    console.log(response);
                    console.log(file);
                    console.log(fileList);
                    this.uploadErrorMessage = [];

                    this.fileList.push({
                        'name': file.name,
                        'url': file.url
                    })
                    // 上传成功之后，把上传的路径和文件列表返回到父组件
                    this.$emit('uploadSuccessPath', response.path)
                    this.$emit('uploadSuccessFiles', this.fileList)
                } else {
                    this.uploadErrorMessage = response.message.image;
                }
            },
            /**
             * 上传失败
             * @param err 错误信息
             * @param file 文件信息
             * @param fileList
             */
            errorHandle(err, file, fileList) {
                this.$message({
                    message: err,
                    type: 'error',
                    showClose: true
                });
            }
        }
    }
</script>

<style lang="scss">
    .el-alert {
        margin: 5px 0;
    }
    input[type="file"] {
        display: none;
    }
</style>