import unittest
import os
from TOOL import mod_config

class MyTestCase(unittest.TestCase):
    def test_Config(self):

        os.chdir("../" )
        syspath = os.getcwd()
        testPath = syspath+mod_config.getConfig("DATAPATH", "TESTPATH")
        self.assertEqual(os.path.exists(testPath), True)


if __name__ == '__main__':
    unittest.main()
