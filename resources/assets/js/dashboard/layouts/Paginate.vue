<template>
    <div class="block">
        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page.sync="currentPage1"
                :page-size="100"
                layout="total, prev, pager, next"
                :total="1000">
        </el-pagination>
    </div>
</template>
<script>
    export default {
        methods: {
            handleSizeChange(val) {
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
                console.log(`当前页: ${val}`);
            }
        },
        data() {
            return {
                currentPage1: 5,
                currentPage2: 5,
                currentPage3: 5,
                currentPage4: 4
            };
        }
    }
</script>

<style lang="scss" scoped>
    .block {
        text-align: center;
        padding-top: 30px;
        font-size: 16px;
    }
</style>