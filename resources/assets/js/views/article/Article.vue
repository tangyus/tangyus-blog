<template>
    <div class="content">
        <div class="content-title">
            <h3>文章管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/articles/create" class="btn btn-primary">创建文章<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>

        <el-table
                :data="tableData"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="分类名称">
            </el-table-column>
            <el-table-column
                    prop="date"
                    label="邮箱">
            </el-table-column>
            <el-table-column
                    prop="address"
                    label="简介">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="editUser(scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteUser(scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <div class="block" v-if="totalPage >= 1">
            <el-pagination
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    layout="total, prev, pager, next"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                tableData: [{
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1517 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1519 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1516 弄'
                }],
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        }
    }
</script>