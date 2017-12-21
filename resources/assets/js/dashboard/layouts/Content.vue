<template>
    <div class="content">
        <div class="content-title">
            <h3>用户管理</h3>
        </div>
        <div class="operate">
            <el-button type="primary">创建用户<i class="el-icon-edit-outline el-icon-right"></i></el-button>
        </div>
        <el-table
                :data="tableData3"
                border
                style="width: 100%;">
            <el-table-column
                    prop="date"
                    label="日期">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名">
            </el-table-column>
            <el-table-column
                    prop="address"
                    label="地址">
            </el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <paginate></paginate>
    </div>
</template>

<script>
    import Paginate from './Paginate.vue';

    export default {
        components: {
            Paginate
        },
        data() {
            return {
                tableData3: [{
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-08',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-06',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-07',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }]
            };
        }
    }
</script>

<style lang="scss" scoped>
    .content {
        border: 1px solid #F2F6FC;
        position: absolute;
        left: 210px;
        top: 70px;
        bottom: 0;
        right: 0;

        .content-title {
            min-height: 50px;
            padding-left: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #DCDFE6;
        }

        .operate {
            line-height: 60px;
            padding-left: 15px;
            margin: 10px auto;
        }
    }
</style>

<style>
    .el-table__body-wrapper {
        overflow: hidden;
    }
</style>