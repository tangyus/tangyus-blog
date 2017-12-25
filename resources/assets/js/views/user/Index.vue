<template>
    <div class="content">
        <div class="content-title">
            <h3>用户管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/users/create" class="btn btn-primary">创建用户<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>
        <el-table
                :data="tableData3"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
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
                    label="邮箱">
            </el-table-column>
            <el-table-column
                    prop="简介"
                    label="introduce">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="注册时间">
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
    import Paginate from '../../dashboard/layouts/Paginate.vue';

    export default {
        components: {
            Paginate
        },
        data() {
            return {
                tableData3: [{
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄',
                    introduce: 'someday means Never',
                    created_at: '2016-05-03'
                }]
            };
        }
    }
</script>

<style lang="scss" scoped>
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

        .btn-primary {
            color: #fff;
            background-color: #409eff;
            border-color: #409eff;
        }
    }
</style>

<style>
    .el-table__body-wrapper {
        overflow: hidden;
    }
</style>