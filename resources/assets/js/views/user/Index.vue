<template>
    <div class="content">
        <div class="content-title">
            <h3>用户管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/users/create" class="btn btn-primary">创建用户<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>
        <el-table
                :data="userList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名">
            </el-table-column>
            <el-table-column
                    prop="email"
                    label="邮箱">
            </el-table-column>
            <el-table-column
                    prop="introduce"
                    label="简介">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="注册时间">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
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
        data() {
            return {
                userList: undefined,
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadUser();
        },
        methods: {
            // 加载用户列表
            loadUser: function (page) {
                var self = this;
                var url = page ? '/user?page=' + page : '/user';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.userList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            editUser: function (row) {
                this.$router.push({path:'users/' + row.id + '/edit'});
            },
            deleteUser: function (row) {
                var self = this;
                this.$http.post('/user/delete/' + row.id)
                        .then(function (response) {
                            if (response.data.success) {
                                self.loadUser(self.currentPage);
                            } else {
                                alert(response.data.message);
                            }
                        })
            },

            // 翻页
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadUser(val);
            }
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

    .block {
        text-align: center;
        font-size: 16px;
        margin-bottom: 75px;
    }
</style>

<style>
    .el-table__body-wrapper {
        overflow: hidden;
    }
</style>